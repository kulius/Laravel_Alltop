<?php

namespace Modules\m01\Http\Controllers;

use App;
use App\Alltop\Combo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class M01120Controller extends Controller
{
    public function __construct(Combo $combo)
    {
        $this->Combo = $combo;
    }

    //
    public function index(Request $request)
    {
        App::setLocale('en');

        $request->flash();
        $data = array(

            array("aaID" => "1", 'GroupNoNo' => 'admin', 'GroupName' => '管理者', 'Notes' => '', 'ChangeTimes' => '2019/08/05 09:00', 'ChangePeople' => '王曉明'),

        );

        return view('m01::M01120.index', array(
            'data' => $data,
        ));

    }

    public function view(Request $request, $status = null, $id = null)
    {
        App::setLocale('en');

        return view('m01::M01120.view', array(
            //'data'   => $data,
            'status' => $status,
            'id'     => $id,

        ));

    }

    public function view2(Request $request, $status = null, $id = null)
    {
        App::setLocale('en');

        return view('m01::M01120.view2', array(
            //'data'   => $data,
            'status' => $status,
        ));

    }

    public function view_tab2(Request $request, $status = null, $id = null)
    {
        App::setLocale('en');

        $request->flash();
        $data = array(

            array("aaID" => "1", 'UserAccount' => 'cxvdfvds', 'Name' => ''),

        );

        return view('m01::M01120.view_tab2', array(
            'data'   => $data,
            'status' => $status,
            'id'     => $id,

        ));

    }

    public function view_tab3(Request $request, $status = null, $id = null)
    {
        App::setLocale('en');

        $request->flash();
        $data = array(

            array("aaID" => "1", 'FunshionNo' => 'a01110', 'FunshionName' => '校名設定'),
            array("aaID" => "1", 'FunshionNo' => 'a01120', 'FunshionName' => '部別設定'),
            array("aaID" => "1", 'FunshionNo' => 'a01130', 'FunshionName' => '班級代碼設定'),

        );

        return view('m01::M01120.view_tab3', array(
            'data'   => $data,
            'status' => $status,
            'id'     => $id,

        ));

    }

}
