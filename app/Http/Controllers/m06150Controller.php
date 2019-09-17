<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class m06150Controller extends Controller
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

        $dataMain   = array();
        $dataMain[] = array('a' => '王小明', 'b' => '呂阿美', 'c' => '2019-08-01', 'd' => '2020-07-31', 'e' => '參加研習');

        return view('m06150.index', array(
            'dataMain' => $dataMain,
        ));
    }

    public function view(Request $request, $status, $id = null)
    {
        $dataMain = array();

        return view('m06150.view', array(
            'status'   => $status,
            'dataMain' => $dataMain,
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

            return redirect()->route('m06150', array('edit', $result->seq));
        } else {
            return redirect()->route('m06150', array($status, $id));
        }
    }
}
