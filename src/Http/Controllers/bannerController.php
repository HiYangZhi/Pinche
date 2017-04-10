<?php

namespace ZCJY\Pinche\Http\Controllers;

use ZCJY\Pinche\Http\Requests\CreatebannerRequest;
use ZCJY\Pinche\Http\Requests\UpdatebannerRequest;
use ZCJY\Pinche\Repositories\bannerRepository;
use ZCJY\Pinche\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Input;
use Storage;

class bannerController extends AppBaseController
{
    /** @var  bannerRepository */
    private $bannerRepository;

    public function __construct(bannerRepository $bannerRepo)
    {
        $this->bannerRepository = $bannerRepo;
    }

    /**
     * Display a listing of the banner.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->bannerRepository->pushCriteria(new RequestCriteria($request));
        $banners = $this->bannerRepository->all();

        return view('banners.index')
            ->with('banners', $banners);
    }

    /**
     * Show the form for creating a new banner.
     *
     * @return Response
     */
    public function create()
    {
        return view('banners.create');
    }

    /**
     * Store a newly created banner in storage.
     *
     * @param CreatebannerRequest $request
     *
     * @return Response
     */
    public function store(CreatebannerRequest $request)
    {
        $input = $request->all();

        $tailImg = Input::file('image');
        if(!is_null($tailImg)){
            $tailnamepath = $this->guid().'.'.$tailImg->getClientOriginalExtension();
            $tailImg->move('uploads/images',$tailnamepath);
            $input['pic_source'] = 'uploads/images/'.$tailnamepath;
        }


        $banner = $this->bannerRepository->create($input);

        Flash::success('Banner saved successfully.');

        return redirect(route('banners.index'));
    }

    /**
     * Display the specified banner.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $banner = $this->bannerRepository->findWithoutFail($id);

        if (empty($banner)) {
            Flash::error('Banner not found');

            return redirect(route('banners.index'));
        }

        return view('banners.show')->with('banner', $banner);
    }

    /**
     * Show the form for editing the specified banner.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $banner = $this->bannerRepository->findWithoutFail($id);

        if (empty($banner)) {
            Flash::error('Banner not found');

            return redirect(route('banners.index'));
        }

        return view('banners.edit')->with('banner', $banner);
    }

    /**
     * Update the specified banner in storage.
     *
     * @param  int              $id
     * @param UpdatebannerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatebannerRequest $request)
    {
        $banner = $this->bannerRepository->findWithoutFail($id);

        if (empty($banner)) {
            Flash::error('Banner not found');

            return redirect(route('banners.index'));
        }

        $input = $request->all();
        $tailImg = Input::file('image');
        if(!is_null($tailImg)){
            //删除原有的图片
            if(Storage::disk('image')->exists($banner->pic_source)){
                Storage::disk('image')->delete($banner->pic_source);
            }
            $tailnamepath = $this->guid().'.'.$tailImg->getClientOriginalExtension();
            $tailImg->move('uploads/images',$tailnamepath);
            $input['pic_source'] = 'uploads/images/'.$tailnamepath;
        }else{
            $input['pic_source'] = $banner->pic_source;
        }

        $banner = $this->bannerRepository->update($input, $id);

        Flash::success('Banner updated successfully.');

        return redirect(route('banners.index'));
    }

    /**
     * Remove the specified banner from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $banner = $this->bannerRepository->findWithoutFail($id);

        if (empty($banner)) {
            Flash::error('Banner not found');

            return redirect(route('banners.index'));
        }

        $this->bannerRepository->delete($id);

        Flash::success('Banner deleted successfully.');

        return redirect(route('banners.index'));
    }


    //生成UUID
    private function guid(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12);
        return $uuid;
    }
}
}
