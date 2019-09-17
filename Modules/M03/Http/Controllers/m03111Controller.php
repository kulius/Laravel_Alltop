<?php

namespace Modules\M03\Http\Controllers;

use App\Alltop\BaseModel;
use App\Database\eOffice\SysBoardClass;
use App\Database\eOffice\SysBoardTemplate;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class m03111Controller extends Controller
{
    public function __construct()
    {
        $this->middleware(array('at.auth'));
    }

    public function index(Request $request)
    {
        $event = $request->event;

        if ($event == 'remove') {
            $tb_sel = json_decode($request->tb_sel, true);
            $tb_sel = ($tb_sel ? $tb_sel : array());
            $tb_del = array_map(function ($item) {return $item['seq'];}, $tb_sel);

            $result = SysBoardTemplate::whereIn('seq', $tb_del)->delete();

            if ($result) {
                Session::flash('sweet', array('success', _i('資料刪除成功！')));
            } else {
                Session::flash('sweet', array('error', _i('資料刪除失敗！')));
            }
        }

        $filter  = array();
        $filters = BaseModel::setWhere($filter);
        $where   = $filters["where"];
        $param   = $filters["param"];

        $sql = "
            SELECT *
            FROM (
                SELECT a.*, b.board_class_name
                FROM tSysBoardTemplate a
                LEFT JOIN tSysBoardClass b ON a.board_class_seq = b.seq
            ) a
            WHERE {$where}";
        $data_main = DB::connection('eOffice')->select($sql, $param);

        // 範本類別
        $where   = array();
        $where[] = array('board_class_status', '1');

        $data_board_class = SysBoardClass::select(array(
            'seq AS value',
            'board_class_name AS text',
        ))
            ->where($where)
            ->get();

        return view('m03::m03111.index', array(
            'data_main'        => $data_main,
            'data_board_class' => $data_board_class,
        ));
    }

    public function view(Request $request, $status, $id = null)
    {
        // 範本資料
        $where   = array();
        $where[] = array('seq', $id);

        $data_main = SysBoardTemplate::where($where)->first();

        // 範本類別
        $where   = array();
        $where[] = array('board_class_status', '1');

        $data_board_class = SysBoardClass::select(array(
            'seq AS value',
            'board_class_name AS text',
        ))
            ->where($where)
            ->get();

        return view('m03::m03111.view', array(
            'status'           => $status,
            'data_main'        => $data_main,
            'data_board_class' => $data_board_class,
        ));
    }

    public function save(Request $request, $status, $id = null)
    {
        $event = $request->event;
        $data  = $request->all();

        if ($event === 'save') {
            $data['board_class_seq']       = implode('|', $data['board_class_seq']);
            $data['board_template_status'] = implode('|', $data['board_template_status']);

            $result = SysBoardTemplate::updateOrCreate(array('seq' => $id), $data);

            if ($result) {
                Session::flash('sweet', array('success', _i('動作執行成功！')));
            } else {
                Session::flash('sweet', array('error', _i('動作執行失敗！')));
            }

            return redirect()->route('m03111_view', array('edit', $result->seq));
        } else {
            return redirect()->route('m03111_view', array($status, $id));
        }
    }
}
