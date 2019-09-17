<?php

namespace App\Http\Controllers;

use App\Database\eOffice\SysMenu;
use App\Database\eOffice\SysParam;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class s01101Controller extends Controller
{
    public function __construct()
    {
        $this->middleware(array('at.auth'));
    }

    public function index(Request $request)
    {
        $event = $request->event;

        if ($event == 'remove') {
            $main_tb_sel = json_decode($request->main_tb_sel, true);
            $main_tb_sel = ($main_tb_sel ? $main_tb_sel : array());
            $main_tb_del = array_map(function ($item) {return $item['seq'];}, $main_tb_sel);

            $sub_tb_sel = json_decode($request->sub_tb_sel, true);
            $sub_tb_sel = ($sub_tb_sel ? $sub_tb_sel : array());
            $sub_tb_del = array_map(function ($item) {return $item['seq'];}, $sub_tb_sel);

            $tb_del = array_merge($main_tb_sel, $sub_tb_sel);

            if ($tb_del) {
                $result = SysMenu::whereIn('seq', $tb_del)->delete();

                if ($result) {
                    Session::flash('sweet', array('success', _i('資料刪除成功！')));
                } else {
                    Session::flash('sweet', array('error', _i('資料刪除失敗！')));
                }
            }
        }

        $menu_upper = isset($request->menu_upper) ? $request->menu_upper : '';

        //子選單
        $where = array();

        if ($menu_upper) {
            $where[] = array('menu_upper', '=', $menu_upper);
        }

        $data_sub = SysMenu::whereNotNull('menu_upper')->where($where)->get();

        //子選單
        $where = array();

        $data_main = SysMenu::whereNull('menu_upper')->where($where)->get();

        //所屬選單
        $data_memu_upper = SysMenu::select(array(
            'menu_number AS value',
            'menu_name AS text',
        ))
            ->whereNull('menu_upper')
            ->orderBy('menu_sort')
            ->orderBy('menu_number')
            ->get();

        $data_auth_info = SysMenu::getAuthInfo();

        return view('s01101.index', array(
            'data_main'       => $data_main,
            'data_sub'        => $data_sub,
            'data_memu_upper' => $data_memu_upper,
            'data_auth_info'  => $data_auth_info,
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
                $data_memu_upper = SysMenu::select(array(
                    'menu_number AS value',
                    "menu_name AS text",
                ))
                    ->whereNull('menu_upper')
                    ->orderBy('menu_sort')
                    ->orderBy('menu_number')
                    ->get();

                return view('s01101.view_sub', array(
                    'status'          => $status,
                    'data'            => $data,
                    'data_memu_upper' => $data_memu_upper,
                ));
                break;
            case 'main':
                //所屬模組
                $where   = array();
                $where[] = array('param_class', '=', '系統模組');

                $data_menu_module = SysParam::select(array(
                    'param_content AS value',
                    "param_remark AS text",
                ))
                    ->where($where)
                    ->orderBy('param_content')
                    ->get();

                return view('s01101.view_main', array(
                    'status'           => $status,
                    'data'             => $data,
                    'data_menu_module' => $data_menu_module,
                ));
                break;
        }
    }

    public function save(Request $request, $status, $view, $id = null)
    {
        $data = $request->all();

        if ($data['event'] === 'save') {
            if ($view == 'main') {
                $data['menu_module'] = implode('|', $data['menu_module']);
            }

            if ($view == 'sub') {
                $data['menu_upper'] = implode('|', $data['menu_upper']);
            }

            $data['menu_hide'] = implode('|', $data['menu_hide']);

            $result = SysMenu::updateOrCreate(array('seq' => $id), $data);

            if ($result) {
                Session::flash('sweet', array('success', _i('動作執行成功！')));
            } else {
                Session::flash('sweet', array('error', _i('動作執行失敗！')));
            }

            return redirect()->route('s01101_view', array('edit', $view, $result->seq));
        } else {
            return redirect()->route('s01101_view', array($status, $view, $id));
        }
    }
}
