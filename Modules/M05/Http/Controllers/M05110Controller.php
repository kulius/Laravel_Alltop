<?php

namespace Modules\M05\Http\Controllers;

use App;
use App\Alltop\Combo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class M05110Controller extends Controller
{
    public function __construct(Combo $combo)
    {
        $this->Combo = $combo;
    }

    //
    public function index(Request $request)
    {
        App::setLocale('en');

        $data   = array();
        $data[] = array(
            'aa' => '系統參數',
            'bb' => '001',
            'cc' => '校名',
            'dd' => 'admin',
            'ee' => '已鎖定',
            'ff' => 'A01110',

        );

        return view('m05::M05110.index', array(
            'data' => $data,
        ));

    }

    public function tab2(Request $request)
    {
        App::setLocale('en');

        $data   = array();
        $data[] = array(
            'aa' => '系統參數',
            'bb' => '001',
            'cc' => '校名',
            'dd' => 'admin',
            'gg' => '已鎖定',
            'hh' => 'A01110',

        );

        return view('m05::M05110.index_tab2', array(
            'data' => $data,
        ));

    }

}
