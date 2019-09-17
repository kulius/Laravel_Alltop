<?php

namespace Modules\m02\Http\Controllers;

use App;
use App\Alltop\Combo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class M02130Controller extends Controller
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
            array('aaID' => '1', 'Account' => 'B45654654', 'Name' => '王曉明', 'BelongUnit' => '教務處', 'AdminName' => ''),
            array('aaID' => '1', 'Account' => 'B45654654', 'Name' => '王進', 'BelongUnit' => '總務處', 'AdminName' => '吳釧'),
        );

        return view('m02::M02130.index', array(
            'data' => $data,
        ));

    }

    public function tab2(Request $request)
    {
        App::setLocale('en');
        //$data   = array();  這裡已經重複宣告
        $data = array(

            array('aaID' => '1', 'DayfgID' => '日間部', 'ClassTypeID' => '全選', 'CollegeID' => '全選', 'UnitID' => '全選', 'AuzObject' => '王一'),

            array('aaID' => '1', 'DayfgID' => '日間部', 'ClassTypeID' => '大學部', 'CollegeID' => '數理學院', 'UnitID' => '數學系', 'AuzObject' => '劉二'),
        );
        return view('m02::M02130.index_tab2', array(
            'data' => $data,
        ));

    }

    public function tab2_view(Request $request, $status = null, $id = null)
    {
        App::setLocale('en');

        return view('m02::M02130.index_tab2_view', array(
            //'data' => $data,
            'status' => $status,
        ));

    }

}
