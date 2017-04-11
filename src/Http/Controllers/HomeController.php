<?php

namespace ZCJY\Pinche\Http\Controllers;

use Illuminate\Http\Request;
use ZCJY\Pinche\Models\Info;
use ZCJY\Pinche\Models\Passenger;
use ZCJY\Pinche\Repositories\InfoRepository;
use Flash;

class HomeController extends Controller
{

    /** @var  InfoRepository */
    private $infoRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(InfoRepository $infoRepo)
    {
        $this->infoRepository = $infoRepo;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infoes = Info::paginate(20);
        return view('pinche::home', compact('infoes'));
    }

    public function users()
    {
        $users = Passenger::paginate(20);
        return view('pinche::user', compact('users'));
    }

    public function deleteInfo($id){
        $info = $this->infoRepository->findWithoutFail($id);
        $info->passengers()->sync([]);

        if (empty($info)) {
            Flash::error('信息不存在');

            return redirect()->back();;
        }

        $this->infoRepository->delete($id);

        Flash::success('信息删除成功');

        return redirect()->back();
    }
}
