<?php

namespace Modules\C3\Http\Controllers;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class C03120Controller extends Controller
{
    // 主畫面
    public function index(Request $request)
    {
        App::setLocale('en');
        $data = array();
        return view('c3::c03120.index', array(
            'data' => $data,
        ));
    }

    public function add(Request $request)
    {
        App::setLocale('en');
        $data = array();
        return view('c3::c03120.add', array(
            'data' => $data,
        ));
    }

    public function add_jump(Request $request)
    {
        App::setLocale('en');
        $data = array();
        return view('c3::c03120.add_jump', array(
            'data' => $data,
        ));
    }

    public function view(Request $request, $status = null, $id = null)
    {
        $data = array();
        return view('c3::c03120.view', array(
            'data'   => $data,
            'status' => $status,
        ));
    }

    public function edit(Request $request, $status = null, $id = null)
    {
        $data = array();
        return view('c3::c03120.edit', array(
            'data'   => $data,
            'status' => $status,
        ));
    }

    public function edit_edit(Request $request, $status = null, $id = null)
    {
        $data = array();
        return view('c3::c03120.edit_edit', array(
            'data'   => $data,
            'status' => $status,
        ));
    }

    public function edit_edit_jump(Request $request, $status = null, $id = null)
    {
        $data = array();
        return view('c3::c03120.edit_edit_jump', array(
            'data'   => $data,
            'status' => $status,
        ));
    }

    public function edit_edit_edit(Request $request, $status = null, $id = null)
    {
        $data = array();
        return view('c3::c03120.edit_edit_edit', array(
            'data'   => $data,
            'status' => $status,
        ));
    }

}
