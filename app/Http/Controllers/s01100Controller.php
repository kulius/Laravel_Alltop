<?php

namespace App\Http\Controllers;

use App\Database\eOffice\SysParam;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class s01100Controller extends Controller
{
    public function __construct()
    {
        $this->middleware(array('at.auth'));
    }

    public function index(Request $request)
    {
        $del   = json_decode($request->tb_sel, true);
        $event = $request->event;

        if ($del && $event == 'remove') {
            $ids_to_delete = array_map(function ($item) {return $item['seq'];}, $del);

            $result = SysParam::whereIn('seq', $ids_to_delete)->delete();

            if ($result) {
                Session::flash('sweet', array('success', '資料刪除成功！'));
            } else {
                Session::flash('sweet', array('error', '資料刪除失敗！'));
            }
        }

        $param_class = (isset($request->param_class) ? $request->param_class : null);

        $where = array();

        if ($param_class) {
            $where[] = array('param_class', '=', $param_class);
        }

        $dataMain = SysParam::where($where)->whereNotNull('param_class')->get();

        $param_class = SysParam::whereNotNull('param_class')->get(array("param_class AS '[key]'"));
        //$request->flashOnly(array('text'));

        return view('s01100.index', array(
            'dataMain'          => $dataMain,
            'param_class_combo' => array(),
        ));
    }
}
