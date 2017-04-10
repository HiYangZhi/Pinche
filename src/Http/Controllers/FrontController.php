<?php

namespace ZCJY\Pinche\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use ZCJY\Pinche\Models\Passenger;
use ZCJY\Pinche\Models\banner;
use ZCJY\Pinche\Models\Info;
use ZCJY\Pinche\Repositories\InfoRepository;
use Flash;

class FrontController extends Controller
{
	private $infoRepository;

	public function __construct(InfoRepository $infoRepo)
    {
        $this->infoRepository = $infoRepo;
        $this->middleware('weixincheck')->except('getPassenger');
    }

    private function current_user(){
        //应该从session获取passenger信息，这里先写固定的做演示用
    	return session('user');
    }

    private function update_user_contact($mobile){
        $this->current_user()->update(['contact' => $mobile]);
    }

    private function get_numeric($val) { 
        if (is_numeric($val)) { 
            return $val + 0; 
        } 
        return 0; 
    } 

    public function index(Request $request)
    {
    	//$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".Config::get('weixin.appid', 'default')."&redirect_uri=".urlencode($request->root().'/weixin')."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
    	//return redirect($url);
        return redirect('/weixin');
    }

    public function weixin(Request $request)
    {

    	//打开首页
    	$inputs = $request->all();
    	
        $type = array_key_exists ( 'type' , $inputs ) ? ($inputs['type'] == '1' ? 1 : 0 ) : 0;
        $dep = array_key_exists ( 'departure' , $inputs ) ? $inputs['departure'] : null;
        $des = array_key_exists ( 'destination' , $inputs ) ? $inputs['destination'] : null;
        $time = array_key_exists ( 'time' , $inputs ) ? $inputs['time'] : null;
        $infos = $this->infoRepository->listPage($type, $dep, $des, $time);
        //车找人
    	return view('front.index', compact('infos', 'type', 'dep', 'des', 'time'));
    }

    public function create(Request $request)
    {
    	return view('front.create');
    }

    public function store(Request $request){
    	$this->validate($request, $this->varifyInfoRules());
        $inputs = $request->all();
        $inputs['passenger_id'] = $this->current_user()->id;
        $infos = $this->infoRepository->create($inputs);
        $request->session()->flash('flash-type', 'success');
        $request->session()->flash('flash-message', '信息提交成功');
        return redirect('/infoes');
    }

    public function infoes(Request $request){
    	$user = $this->current_user();
    	$mypublish = $user->infoes()->get();
    	foreach ($mypublish as $item) {
		    $item['addinfo'] = '我发布的';
		}
        $customers = $user->participations()->get();
        foreach ($customers as $item) {
		    $item['addinfo'] = '我参与的';
		}
        $infoes = $mypublish->merge($customers)->sortByDesc('time');

        //提示信息
        if ($request->session()->has('flash-type')) {
		    call_user_func ( 'Flash::'.session('flash-type'),  session('flash-message'));
		}
        return view('front.infoes', compact('infoes'));
    }

    public function show($id)
    {
    	$user = $this->current_user();
    	$info = $this->infoRepository->findWithoutFail($id);
        if (empty($info)) {
            Flash::error('信息不存在');
            return redirect('/infos');
        }
        //是否本人发起的信息
        $owner = $info->passenger_id == $user->id;

        if ($owner) {
            //信息为当前用户发布，返回所有参与者信息
            $participants = $info->passengers()->get();
        } else {
            //只返回自己的信息
            $participants = $info->passengers()->where('passenger_id', $user->id)->get();
        }
        
        return view('front.show', compact('info', 'participants', 'owner'));
    }

    public function detail($id)
    {
    	$info = $this->infoRepository->findWithoutFail($id);
        if (empty($info)) {
            Flash::error('信息不存在');
            return redirect('/infos');
        }
         return view('front.show-index', compact('info'));
    }

    public function edit($id)
    {
    	$info = $this->infoRepository->findWithoutFail($id);
        if (empty($info)) {
            Flash::error('信息不存在');
            return redirect()->back();
        }
        return view('front.edit', compact('info'));
    }

    public function update($id, Request $request)
    {
    	//修改信息
    	$this->validate($request, $this->varifyInfoRules());
    	$info = $this->infoRepository->findWithoutFail($id);
        if (empty($info)) {
            Flash::error('信息不存在');
            return redirect()->back();
        }
        $info->update($request->all());

        //跳转显示修改后的信息
        $user = $this->current_user();
        $owner = $info->passenger_id == $user->id;
        if ($owner) {
            //信息为当前用户发布，返回所有参与者信息
            $participants = $info->passengers()->get();
        } else {
            //只返回自己的信息
            $participants = $info->passengers()->where('passenger_id', $user->id)->get();
        }
        Flash::success('信息修改成功');
        return view('front.show', compact('info', 'participants', 'owner'));

    }
    /**
     * 用户参与拼车
     * @param  [type]  $id      [description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function participate($id, Request $request)
    {
    	//获取请求参数
        $inputs = $request->all();
        if(!array_key_exists ( 'contact' , $inputs ) || !array_key_exists ( 'seat' , $inputs ) || !is_numeric( $inputs['seat']) || $inputs['contact'] == '' ){
            Flash::error('失败！ 请正确填写您的联系方式与需求座位数');
            return redirect()->back();
        }
    	$user = $this->current_user();

        //拼车信息
        $info = $this->infoRepository->findWithoutFail($id);
        if (empty($info)) {
        	Flash::error('失败！ 拼车信息不存在');
            return redirect()->back();
        }

        //自己不能报名自己的
        if ($info->passenger_id == $user->id) {
        	Flash::error('失败！ 您不能参与自己发布的信息');
            return redirect()->back();
        }

        //获取已有参者信息
        $ask_seat = $this->get_numeric($inputs['seat']);

        if( $info->seat < ($info->seat_taken + $ask_seat)){
        	Flash::error('失败！ 剩余座位数不够，只剩' . ($info->seat - $info->seat_taken) . '个座位');
            return redirect()->back();
        }

        //用户是否已经报过名了
        $existing_user = $info->passengers()->get();
        $user_number = $existing_user->count();
        for ($i=0; $i < $user_number; $i++) { 
            if ($existing_user[0]->pivot->passenger_id == $user->id) {
                Flash::error('失败！ 您已经报过名了');
            	return redirect()->back();
            }
        }

        //确认参与信息
        $info->passengers()->attach($user->id, ['contact' => $inputs['contact'], 'seat' => $ask_seat]);

        //修改拼车信息中已经占用的座位信息
        $info->seat_taken += $ask_seat;
        $info->save();
        flash('信息提交成功', 'success');
        return redirect('/show/'.$info->id);
    }

    public function cancel($id, Request $request)
    {
    	//拼车信息
        $info = $this->infoRepository->findWithoutFail($id);
        if (empty($info)) {
        	Flash::error('失败！ 拼车信息不存在');
            return redirect()->back();
        }
    	$user = $this->current_user();
        if ($info->passenger_id == $user->id) {
        	//自己是信息的发布者，删除信息
        	$info->passengers()->sync([]);
        	Info::destroy($id);
        }else{
            $participants = $info->passengers()->where('passenger_id', $user->id)->where('info_id', $info->id)->get();
            if (!$participants>isEmpty()) {
                $info->seat_taken -= $participants[0]->pivot->seat;
                $info->save();
            }
        	$info->passengers()->detach([$user->id]);
        }
        Flash::success($info->time.'从'.$info->departure.'到'.$info->destination.'的行程已取消');
        return redirect('/infoes');
    }

    /**
     * 获取用户信息
     * @param  [type] $code [description]
     * @return [type]       [description]
     */
    public function getPassenger(Request $request){

    	$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".Config::get('weixin.appid', '')."&secret=".Config::get('weixin.secret', '')."&code=".$request['code']."&grant_type=authorization_code";
        $rt = json_decode(httpGet($url));
        $access_token = $rt->access_token;
        $open_id = $rt->openid;

        $url2 = "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$open_id."&lang=zh_CN";
        $user_info = json_decode(httpGet($url2));

        //检查openid是否注册，没有就注册一个
        $result = Passenger::where('openid', $user_info->openid)->get(); 

        $user_info_array = array(
            	'openid' => $user_info->openid,
            	'nickname' => $user_info->nickname,
            	'city' => $user_info->city,
            	'province' => $user_info->province,
            	'country' => $user_info->country,
            	'headimgurl' => $user_info->headimgurl,
            	'contact' => ''
            	);
        if ($user_info->sex == 1) {
        	$user_info_array['sex'] = "男";
        }elseif ($user_info->sex == 2) {
        	$user_info_array['sex'] = "女";
        }else {
        	$user_info_array['sex'] = "未知";
        }
        
        if ($result->isEmpty()) {
            $passenger = Passenger::create($user_info_array);
            session(['user' => $passenger]);
        }else{
            $passenger = $result[0];
            unset($user_info_array['openid']);
            $passenger->update($user_info_array);
            //return $passenger;
            session(['user' => $passenger]);
        }
        return redirect($request['state']);
    }

    private function varifyInfoRules(){
    	return [
	        'type' => 'required',
	        'departure' => 'required | max:6',
	        'destination' => 'required | max:6',
	        'time' => 'required | max:19 | min:19',
	        'price' => 'required',
	        'seat' => 'required',
	        'contact' => 'required | max:11',
	    ];
    }
}