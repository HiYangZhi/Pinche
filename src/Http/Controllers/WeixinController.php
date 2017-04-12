<?php

namespace ZCJY\Pinche\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use ZCJY\Pinche\Models\Passenger;

class WeixinController extends Controller
{

    /**
     * 获取用户信息
     * @param  [type] $code [description]
     * @return [type]       [description]
     */
    public function getPassenger(Request $request){

    	$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".Config::get('pinche.appid', '')."&secret=".Config::get('pinche.secret', '')."&code=".$request['code']."&grant_type=authorization_code";
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
}