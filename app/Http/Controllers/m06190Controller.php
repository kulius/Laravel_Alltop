<?php

namespace App\Http\Controllers;

use App\Database\eOffice\SysMenu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class m06190Controller extends Controller
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
            $ids_to_delete = array_map(function ($item) {return $item['group_number'];}, $del);

            $result = SysGroup::whereIn('group_number', $ids_to_delete)->delete();

            if ($result) {
                Session::flash('sweet', array('success', '資料刪除成功！'));
            } else {
                Session::flash('sweet', array('error', '資料刪除失敗！'));
            }
        }

        //$param_class = isset($request->param_class) ? $request->param_class : '';

        //子選單
        $where = array();
        //$where[] = array('param_class', '=', $param_class);

        $dataSub = SysMenu::whereNotNull('menu_upper')->where($where)->get();

        //子選單
        $where = array();

        $dataMain = SysMenu::whereNull('menu_upper')->where($where)->get();

        //所屬選單
        $dataMenuUpper = SysMenu::select(array(
            'menu_number AS value',
            'menu_name AS text',
        ))
            ->whereNull('menu_upper')
            ->orderBy('menu_sort')
            ->orderBy('menu_number')
            ->get();

        return view('s01101.index', array(
            'dataMain'      => $dataMain,
            'dataSub'       => $dataSub,
            'dataMenuUpper' => $dataMenuUpper,
        ));
    }

    public function view(Request $request, $status, $view, $id = null)
    {
        //選單資料
        $where   = array();
        $where[] = array("seq", $id);

        $data = SysMenu::where($where)->first();

        switch ($view) {
            case 'sub':
                //所屬選單
                $dataMenuUpper = SysMenu::select(array(
                    'menu_number AS value',
                    "menu_name AS text",
                ))
                    ->whereNull('menu_upper')
                    ->orderBy('menu_sort')
                    ->orderBy('menu_number')
                    ->get();

                return view('s01101.view_sub', array(
                    'status'        => $status,
                    'data'          => $data,
                    'dataMenuUpper' => $dataMenuUpper,
                ));
                break;
            case 'main':
                //所屬模組
                $where   = array();
                $where[] = array('param_class', '=', '系統模組');

                $dataMenuModule = SysMenu::select(array(
                    'param_content AS value',
                    "param_remark AS text",
                ))
                    ->where($where)
                    ->orderBy('param_content')
                    ->get();

                return view('s01101.view_main', array(
                    'status'         => $status,
                    'data'           => $data,
                    'dataMenuModule' => $dataMenuModule,
                ));
                break;
        }
    }

    public function save(Request $request, $status, $view, $id = null)
    {
        $data = $request->all();

        if ($data['event'] === 'save') {
            $result = SysMenu::updateOrCreate(array('seq' => $id), $data);

            if ($result) {
                Session::flash('sweet', array('success', '動作執行成功！'));
            } else {
                Session::flash('sweet', array('error', '動作執行失敗！'));
            }

            return redirect()->route('s01101_view', array('edit', $view, $result->seq));
        } else {
            return redirect()->route('s01101_view', array($status, $view, $id));
        }
    }
}
