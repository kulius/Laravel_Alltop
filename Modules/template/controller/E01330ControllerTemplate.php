<?php

namespace Modules\E1\Http\Controllers;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class E01330ControllerTemplate extends Controller
{
    // 主畫面
    public function index(Request $request)
    {
        App::setLocale('en');
        $data = array();
        return view('e1::E01330.index', array(
            'data' => $data,
        ));
    }

    public function view(Request $request, $status = null, $id = null)
    {
        $data = null;
        return view('e1::E01330.view', array(
            'data'   => $data,
            'status' => $status,
        ));
    }

}
