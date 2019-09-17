<?php

namespace Modules\m01\Http\Controllers;

use App;
use App\Alltop\Combo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class M01130Controller extends Controller
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
            array('aaID' => '1', 'ChineseName' => '首頁區', 'CodeNo' => '01101', 'CatalogNo' => '0001', 'iconData' => 'default.png', 'Information' => '*', 'State' => '顯示', 'ChangeDate' => '2019/06/24', 'ChangePeople' => '王曉明', 'Reason' => '', 'FunctionState' => '啟用'),
            array('aaID' => '1', 'ChineseName' => '公布欄', 'CodeNo' => '01102', 'CatalogNo' => '0002', 'iconData' => 'default.png', 'Information' => '*', 'State' => '顯示', 'ChangeDate' => '', 'ChangePeople' => '', 'Reason' => '', 'FunctionState' => '啟用'),
            array('aaID' => '1', 'ChineseName' => '預算核銷', 'CodeNo' => '01103', 'CatalogNo' => '0003', 'iconData' => 'default.png', 'Information' => '*', 'State' => '顯示', 'ChangeDate' => '', 'ChangePeople' => '', 'Reason' => '', 'FunctionState' => '啟用'),

        );

        return view('m01::M01130.index', array(
            'data' => $data,
        ));

    }

    public function view(Request $request, $status = null, $id = null)
    {
        App::setLocale('en');

        return view('m01::M01130.view', array(
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

        return view('m01::M01130.index_tab2', array(
            'data' => $data,
        ));

    }

    public function tab2_view(Request $request, $status = null, $id = null)
    {
        App::setLocale('en');

        return view('m01::M01130.index_tab2_view', array(
            //'data' => $data,
            'status' => $status,
        ));

    }

}
