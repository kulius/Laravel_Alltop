<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class m06130Controller extends Controller
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
            /*
            $ids_to_delete = array_map(function ($item) {return $item['group_number'];}, $del);
            $result = SysGroup::whereIn('group_number', $ids_to_delete)->delete();
             */

            $result = true;

            if ($result) {
                Session::flash('sweet', array('success', '資料刪除成功！'));
            } else {
                Session::flash('sweet', array('error', '資料刪除失敗！'));
            }
        }

        $dataForm   = array();
        $dataForm[] = array('a' => '請假單', 'b' => 'default', 'c' => '預設範本');

        $dataCustom   = array();
        $dataCustom[] = array('a' => 'AS070', 'b' => '自訂表單範本');

        return view('m06130.index', array(
            'dataForm'   => $dataForm,
            'dataCustom' => $dataCustom,
        ));
    }

    public function view(Request $request, $status, $id = null)
    {
        $dataMain = array();
        $dataGrid = array();

        return view('m06130.view', array(
            'dataMain' => $dataMain,
            'dataGrid' => $dataGrid,
        ));
    }

    public function view_custom(Request $request, $status, $id = null)
    {
        $dataMain = array();

        return view('m06130.view_custom', array(
            'dataMain' => $dataMain,
        ));
    }

    public function view_grid(Request $request, $status, $id, $grid_status, $grid_id = null)
    {
        $dataMain = array('level_type' => null);
        $dataGrid = array();

        return view('m06130.view_grid', array(
            'dataMain' => $dataMain,
            'dataGrid' => $dataGrid,
        ));
    }

    public function save(Request $request, $status, $id = null)
    {
        $data = $request->all();

        if ($data['event'] === 'save') {
            $result = true;
            //$result = SysMenu::updateOrCreate(array('seq' => $id), $data);

            if ($result) {
                Session::flash('sweet', array('success', '動作執行成功！'));
            } else {
                Session::flash('sweet', array('error', '動作執行失敗！'));
            }

            return redirect()->route('m06130', array('edit', $result->seq));
        } else {
            return redirect()->route('m06130', array($status, $id));
        }
    }

    public function save_grid(Request $request, $id, $status, $grid_id = null)
    {
        $event = $request->get('event');

        if ($event === 'save') {
            $data = $request->all();
            /*
        $result = SysExample::updateOrCreate(array('seq' => $id), $data);

        if ($result) {
        Session::flash('sweet', array('success', '動作執行成功！'));
        } else {
        Session::flash('sweet', array('error', '動作執行失敗！'));
        }

        return redirect()->route('e00100_view', array('edit', $result->seq));
         */
        } else {
            $dataMain = $request->all();
            $dataGrid = array();

            return view('m06130.view_grid', array(
                'dataMain' => $dataMain,
                'dataGrid' => $dataGrid,
            ));
        }
    }
}
