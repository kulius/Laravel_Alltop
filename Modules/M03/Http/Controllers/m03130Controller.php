<?php

namespace Modules\M03\Http\Controllers;

use App\Database\eOffice\SysGroup;
use App\Database\eOffice\SysGroupUser;
use App\Database\eOffice\SysMenu;
use App\Database\eOffice\SysUser;
use App\Database\eOffice\SysUserGrant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class m03130Controller extends Controller
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
            $tb_del = array_map(function ($item) {return $item['user_number'];}, $tb_sel);

            $result = SysUser::whereIn('user_number', $tb_del)->delete();

            if ($result) {
                SysUserGrant::whereIn('user_number', $tb_del)->delete();
                SysGroupUser::whereIn('user_number', $tb_del)->delete();

                Session::flash('sweet', array('success', _i('資料刪除成功！')));
            } else {
                Session::flash('sweet', array('error', _i('資料刪除失敗！')));
            }
        }

        $where = array();
        /*$param_class = (isset($request->param_class) ? $request->param_class : null);

        $where = array();

        if ($param_class) {
        $where[] = array('param_class', '=', $param_class);
        }
         */

        $data_main = SysUser::where($where)->take(200)->get();

        return view('s01200.index', array(
            'data_main' => $data_main,
        ));
    }

    public function view(Request $request, $status, $id = null)
    {
        //帳戶資料
        $where   = array();
        $where[] = array('user_number', $id);

        $data_main = SysUser::where($where)->first();

        //群組
        $data_group = SysGroup::get();

        //群組（授權）
        $filter   = array();
        $filter[] = array('user_number = ?', $id);

        $data_group_auth = SysUser::getGroupAuth($filter);

        //選單
        $data_menu = SysMenu::whereNotNull('menu_upper')->get();

        //選單（授權）
        $filter   = array();
        $filter[] = array('user_number = ?', $id);

        $data_menu_auth = SysUser::getMenuAuth($filter);

        $data_menu_upper = SysMenu::select(array(
            'menu_number AS value',
            'menu_name AS text',
        ))
            ->whereNull('menu_upper')
            ->orderBy('menu_sort')
            ->orderBy('menu_number')
            ->get();

        $data_auth_info = SysMenu::getAuthInfo();

        return view('s01200.view', array(
            'status'          => $status,
            'data_main'       => $data_main,
            'data_group'      => $data_group,
            'data_group_auth' => $data_group_auth,
            'data_menu'       => $data_menu,
            'data_menu_auth'  => $data_menu_auth,
            'data_menu_upper' => $data_menu_upper,
            'data_auth_info'  => $data_auth_info,
        ));
    }

    public function save(Request $request, $status, $id = null)
    {
        $event = $request->get('event');

        $data = $request->all();

        if ($event === 'save') {
            $data['authorize'] = implode('|', $data['authorize']);

            //帳戶資料
            $result = SysUser::updateOrCreate(array('user_number' => $id), $data);

            if ($result) {
                $user_number = $result->user_number;

                //授權群組
                //刪除
                SysGroupUser::where(array('user_number' => $user_number))
                    ->delete();

                //新增
                $tb_sel = json_decode($data['group_tb_sel'], true);

                if ($tb_sel) {
                    $data_group = array();

                    foreach ($tb_sel as $sKey => $sValue) {
                        $data_group[] = array(
                            'group_number' => $sValue['group_number'],
                            'user_number'  => $user_number,
                        );
                    }

                    SysGroupUser::insert($data_group);
                }

                //授權功能
                //刪除
                SysUserGrant::where(array('user_number' => $user_number))
                    ->delete();

                //新增
                $tb_sel = json_decode($data['menu_tb_sel'], true);

                if ($tb_sel) {
                    $data_menu = array();

                    foreach ($tb_sel as $sKey => $sValue) {
                        $data_menu[] = array(
                            'menu_number' => $sValue['menu_number'],
                            'user_number' => $user_number,
                        );
                    }

                    SysUserGrant::insert($data_menu);
                }

                if ($result) {
                    Session::flash('sweet', array('success', _i('動作執行成功！')));
                } else {
                    Session::flash('sweet', array('error', _i('動作執行失敗！')));
                }

                return redirect()->route('s01200_view', array('edit', $user_number));
            }
        } else {
            return redirect()->route('s01200_view', array($status, $id));
        }
    }
}
