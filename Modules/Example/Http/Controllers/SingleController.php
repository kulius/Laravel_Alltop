<?php

namespace Modules\Example\Http\Controllers;

use App;
use App\Alltop\JumpHandler;
use App\Database\eOffice\SysExample;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SingleController extends Controller
{
    public function __construct() {}

    public function index(Request $request)
    {
        App::setLocale('en');

        $del   = json_decode($request->tb_sel, true);
        $event = $request->event;

        if ($del && $event == 'remove') {
            $ids_to_delete = array_map(function ($item) {return $item['seq'];}, $del);

            $result = SysExample::whereIn('seq', $ids_to_delete)->delete();

            if ($result) {
                Session::flash('sweet', array('success', '資料刪除成功！'));
            } else {
                Session::flash('sweet', array('error', '資料刪除失敗！'));
            }
        }

        $text = isset($request->text) ? $request->text : '';
        // 查詢
        $where = array(
            array('text', 'like', "%{$text}%"),
        );

        $data = SysExample::where($where)->get();

        $request->flashOnly(array('text'));

        return view('example::Single.index', array(
            'data' => $data,
        ));
    }

    public function view(Request $request, $status = null, $id = null)
    {
        if ($status == 'view') {
            session()->flash('status', 'view');
        }
        $data = SysExample::where('seq', $id)->first();

        return view('example::Single.view', array(
            'data'   => $data,
            'status' => $status,
        ));
    }

    public function save(Request $request, $status = null, $id = null)
    {

        $event = $request->get('event');

        $data          = $request->all();
        $data['radio'] = isset($data['radio']) ? $data['radio'][0] : null;
        $data['check'] = isset($data['check']) ? $data['check'] : null;
        $data['drop']  = isset($data['drop']) ? $data['drop'][0] : null;
        $data['jump']  = isset($data['jump']) ? $data['jump'] : null;

        if ($event === 'save') {
            $result = SysExample::updateOrCreate(array('seq' => $id), $data);

            if ($result) {
                Session::flash('sweet', array('success', '動作執行成功！'));
            } else {
                Session::flash('sweet', array('error', '動作執行失敗！'));
            }

            return redirect()->route('e00100_view', array('edit', $result->seq));
        } else {
            return view('example::Single.view', array(
                'data'   => $data,
                'status' => $status,
            ));
        }
    }

    //get post寫在一起
    public function jumpget(Request $request)
    {
        $sEvent       = $request->event;
        $sJumpSelName = $request->jump_tb_sel;
        $aJumpSel     = json_decode($request->jump_tb_sel, true);
        //Route::post()時，觸發 select event
        if ($sEvent == 'select') {
            $sScript = JumpHandler::setJumpSelData(array(
                'name'  => 'jump', // dropbox 的 name
                "data"  => $aJumpSel,
                "value" => "seq",         //要帶回到 dropbox 的 key 值
                "text"  => array("data"), //要顯示在 dropbox 上的名稱, $aJumpSel[0]['data']
            ));
            //直接回傳 Js Script
            return $sScript;
        }

        return view('example::E00000.jump.index_form_jump_sgl');
    }
}
