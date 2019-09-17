<?php

namespace App\Http\Controllers;

use App\Database\eOffice\SysGroup;
use App\Database\eOffice\SysGroupGrant;
use App\Database\eOffice\SysGroupUser;
use App\Database\eOffice\SysMenu;
use App\Database\eOffice\SysUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class s01201Controller extends Controller
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
            $tb_del = array_map(function ($item) {return $item['group_number'];}, $tb_sel);

            $result = SysGroup::whereIn('group_number', $tb_del)->delete();

            if ($result) {
                SysGroupGrant::whereIn('group_number', $tb_del)->delete();
                SysGroupUser::whereIn('group_number', $tb_del)->delete();

                Session::flash('sweet', array('success', _i('資料刪除成功！')));
            } else {
                Session::flash('sweet', array('error', _i('資料刪除失敗！')));
            }
        }

        //$param_class = isset($request->param_class) ? $request->param_class : '';

        $where = array();
        //$where[] = array('param_class', '=', $param_class);

        $data_main = SysGroup::where($where)->get();

        return view('s01201.index', array(
            'data_main' => $data_main,
        ));
    }

    public function view(Request $request, $status, $id = null)
    {
        //群組資料
        $data = SysGroup::where('group_number', $id)->first();

        //使用者
        $data_user = SysUser::get();

        //使用者（授權）
        $filter   = array();
        $filter[] = array('group_number = ?', $id);

        $data_user_auth = SysGroup::getUserAuth($filter);

        //選單
        $data_menu = SysMenu::whereNotNull('menu_upper')->get();

        //選單（授權）
        $filter   = array();
        $filter[] = array('group_number = ?', $id);

        $data_menu_auth = SysGroup::getMenuAuth($filter);

        $data_menu_upper = SysMenu::select(array(
            'menu_number AS value',
            "menu_name AS text",
        ))
            ->whereNull('menu_upper')
            ->orderBy('menu_sort')
            ->orderBy('menu_number')
            ->get();

        $data_auth_info = SysMenu::getAuthInfo();

        return view('s01201.view', array(
            'status'          => $status,
            'data'            => $data,
            'data_user'       => $data_user,
            'data_user_auth'  => $data_user_auth,
            'data_menu'       => $data_menu,
            'data_menu_auth'  => $data_menu_auth,
            'data_menu_upper' => $data_menu_upper,
            'data_auth_info'  => $data_auth_info,
        ));
    }

    public function save(Request $request, $status = null, $id = null)
    {
        $event = $request->get('event');

        $data = $request->all();

        if ($event === 'save') {
            //群組資料
            $result = SysGroup::updateOrCreate(array('group_number' => $id), $data);

            if ($result) {
                $group_number = $result->group_number;

                //群組人員
                //刪除
                SysGroupUser::where(array('group_number' => $group_number))
                    ->delete();

                //新增
                $aSel = json_decode($data["users_tb_sel"], true);

                if ($aSel) {
                    $dataUser = array();

                    foreach ($aSel as $sKey => $sValue) {
                        $dataUser[] = array(
                            "group_number" => $group_number,
                            "user_number"  => $sValue["user_number"],
                        );
                    }

                    SysGroupUser::insert($dataUser);
                }

                //功能權限
                //刪除
                SysGroupGrant::where(array('group_number' => $group_number))
                    ->delete();

                //新增
                $aSel = json_decode($data["menu_tb_sel"], true);

                if ($aSel) {
                    $dataMenu = array();

                    foreach ($aSel as $sKey => $sValue) {
                        $dataMenu[] = array(
                            "group_number" => $group_number,
                            "menu_number"  => $sValue["menu_number"],
                        );
                    }

                    SysGroupGrant::insert($dataMenu);
                }

                if ($result) {
                    Session::flash('sweet', array('success', _i('動作執行成功！')));
                } else {
                    Session::flash('sweet', array('error', _i('動作執行失敗！')));
                }

                return redirect()->route('s01201_view', array('edit', $group_number));
            }
        } else {
            return redirect()->route('s01201_view', array($status, $id));
        }
    }
}
