<?php

namespace Modules\M03\Http\Controllers;

use App\Database\eOffice\SysBoardClass;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class m03110Controller extends Controller
{
    public function __construct()
    {
        $this->middleware(array('at.auth'));
    }

    public function index(Request $request)
    {
        $data_main = SysBoardClass::orderBy('board_class_status', 'desc')->get();

        return view('m03::m03110.index', array(
            'data_main' => $data_main,
        ));
    }

    public function save(Request $request)
    {
        $event = $request->event;

        switch ($event) {
            case 'save':
                $tb_sel = json_decode($request->tb_ins_upd, true);
                $tb_sel = ($tb_sel ? $tb_sel : array());

                if ($tb_sel) {
                    foreach ($tb_sel as $_key => $_value) {
                        $seq = (isset($_value['seq']) ? $_value['seq'] : null);

                        SysBoardClass::updateOrCreate(array('seq' => $seq), $_value);
                    }

                    Session::flash('sweet', array('success', _i('動作執行成功！')));
                } else {
                    Session::flash('sweet', array('success', _i('未異動任何資料！')));
                }
                break;
        }

        return redirect()->route('m03110');
    }
}
