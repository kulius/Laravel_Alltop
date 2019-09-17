<?php

namespace Modules\m02\Http\Controllers;

use App;
use App\Alltop\Combo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class M02110Controller extends Controller
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

            array("aaID" => "1", 'Account' => '', 'JobName' => '', 'Name' => '', 'Notes' => '', 'Auz' => ''),

        );

        return view('m02::M02110.index', array(
            'data' => $data,
        ));

    }

    public function view(Request $request, $status = null, $id = null)
    {
        App::setLocale('en');

        return view('m02::M02110.view', array(
            //'data'   => $data,
            'status' => $status,
            'id'     => $id,
        ));

    }

    // public function view_top(Request $request, $status = null, $id = null)
    // {
    //     App::setLocale('en');

    //     return view('m02::M02110.view_top', array(
    //         //'data'   => $data,
    //         'status' => $status,
    //     ));

    // }

    public function view_tab2(Request $request, $status = null, $id = null)
    {
        App::setLocale('en');

        $request->flash();

        return view('m02::M02110.view_tab2', array(
            //'data'   => $data,
            'status' => $status,
            'id'     => $id,
        ));

    }

    public function view_tab3(Request $request, $status = null, $id = null)
    {
        App::setLocale('en');

        $request->flash();
        $data = array(

            array("aaID" => "1", 'ChineseName' => '01000 首頁區', 'AuzGroupNo' => 'default', 'aa' => '授權'),
            array("aaID" => "2", 'ChineseName' => '    S11 系統管理', 'AuzGroupNo' => '', 'aa' => '授權'),
            array("aaID" => "3", 'ChineseName' => '    S1110 即時狀態 ', 'AuzGroupNo' => 'default', 'aa' => '停權'),
            array("aaID" => "4", 'ChineseName' => '    S1120 參數維護', 'AuzGroupNo' => '', 'aa' => '停權'),

        );

        return view('m02::M02110.view_tab3', array(
            'data'   => $data,
            'status' => $status,
            'id'     => $id,
        ));

    }

}
