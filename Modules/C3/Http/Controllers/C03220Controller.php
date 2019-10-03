<?php

namespace Modules\C3\Http\Controllers;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class C03220Controller extends Controller
{
    // 主畫面
    public function index(Request $request)
    {
        App::setLocale('en');
        $data = array();
        return view('c3::c03220.index', array(
            'data' => $data,
        ));
    }

    public function fill(Request $request)
    {
        App::setLocale('en');
        $data = array();
        return view('c3::c03220.fill', array(
            'data' => $data,
        ));
    }

    public function view(Request $request, $status = null, $id = null)
    {
        $data = null;
        return view('c3::c03220.view', array(
            'data'   => $data,
            'status' => $status,
        ));
    }

}
