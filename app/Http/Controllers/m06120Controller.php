<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class m06120Controller extends Controller
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
        $dataMain[] = array('a' => 'AS070', 'b' => '臨時警備隊', 'c' => true);
        $dataMain[] = array('a' => 'DA120', 'b' => '人事室', 'c' => false);

        return view('m06120.index', array(
            'dataMain' => $dataMain,
        ));
    }

    public function view(Request $request, $id)
    {
        $dataMain   = array();
        $dataGrid   = array();
        $dataGrid[] = array('a' => 'AS070A0101', 'b' => '主任', 'c' => '王小明', 'd' => '一級主管');
        $dataGrid[] = array('a' => 'AS070A0201', 'b' => '副主任', 'c' => '陳大華', 'd' => '二級主管');

        switch ($id) {
            case 'AS070':
                $dataMain = array('a' => 'AS070', 'b' => '臨時警備隊');
                break;
            case 'DA120':
                $dataMain = array('a' => 'DA120', 'b' => '人事室');
                break;
        }

        return view('m06120.view', array(
            'dataMain' => $dataMain,
            'dataGrid' => $dataGrid,
        ));
    }

    public function view2(Request $request, $id, $status, $id2 = null)
    {
        $dataMain = array();

        return view('m06120.view2', array(
            'id'       => $id,
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

            return redirect()->route('m06120', array('edit', $result->seq));
        } else {
            return redirect()->route('m06120', array($status, $id));
        }
    }
}
