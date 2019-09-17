<?php

namespace Modules\m01\Http\Controllers;

use App;
use App\Alltop\Combo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class M01110Controller extends Controller
{
    public function __construct(Combo $combo)
    {
        $this->Combo = $combo;
    }

    //
    public function index(Request $request)
    {
        App::setLocale('en');

        $data = array(
            array('aaID' => '1', 'MenuNo' => 'a01', 'MenuName' => '新生管理', 'BelongProject' => 'AcademicAffairs', 'ListSort' => '50', 'IfShow' => '是', 'ChangeDate' => '2019/08/05 09:00'),

        );

        return view('m01::M01110.index', array(
            'data' => $data,
        ));

    }

    public function view(Request $request, $status = null, $id = null)
    {
        App::setLocale('en');

        return view('m01::M01110.view', array(
            //'data' => $data,
            'status' => $status,
        ));

    }

    public function tab2(Request $request)
    {
        App::setLocale('en');
        //$data   = array();  這裡已經重複宣告
        $data = array(

            array('aaID' => '1', 'BelongMenu' => '【a01】新生管理', 'FunctionNo' => 'a01110', 'FunctionName' => '校名設定', 'FunctionDataList' => 'a01110_regSchoolName', 'ListSort' => '50', 'IfShow' => '是', 'ReEndTime' => '2019/08/05 09:00'),
        );

        return view('m01::M01110.index_tab2', array(
            'data' => $data,
        ));

    }

    public function tab2_view(Request $request, $status = null, $id = null)
    {
        App::setLocale('en');

        return view('m01::M01110.index_tab2_view', array(
            //'data' => $data,
            'status' => $status,
        ));

    }

}
