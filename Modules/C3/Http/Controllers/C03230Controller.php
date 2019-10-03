<?php

namespace Modules\C3\Http\Controllers;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class C03230Controller extends Controller
{
    // 主畫面
    public function index(Request $request)
    {
        App::setLocale('en');
        $data = array();
        return view('c3::c03230.index', array(
            'data' => $data,
        ));
    }

    public function import(Request $request)
    {
        App::setLocale('en');
        $data = array();
        return view('c3::c03230.import', array(
            'data' => $data,
        ));
    }

}
