<?php

namespace App\Http\Controllers\ModuleNtue\NewStudent;

use App\Database\ACAD\tDayfg;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class regDayfgController extends Controller
{
    //
    public function index(Request $request)
    {
        $del   = json_decode($request->tb_sel, true);
        $event = $request->event;
        // dd($del, $request);
        if ($del && $event == 'remove') {
            $ids_to_delete = array_map(function ($item) {return $item['DayfgID'];}, $del);

            $result = tDayfg::whereIn('DayfgID', $ids_to_delete)->delete();

            if ($result) {
                Session::flash('sweet', array('success', '資料刪除成功！'));
            } else {
                Session::flash('sweet', array('error', '資料刪除失敗！'));
            }
        }

        $data = tDayfg::all();

        return view('ModuleNtue.NewStudent.regDayfg.index', array(
            'data' => $data,
        ));
    }

    public function view(Request $request, $status = null, $id = null)
    {
        $data = tDayfg::where('DayfgID', $id)->first();

        return view('ModuleNtue.NewStudent.regDayfg.view', array(
            'data'   => $data,
            'status' => $status,
        ));
    }

    public function save(Request $request, $status = null, $id = null)
    {
        $act = $request->get('act');

        $data = $request->all();
        // dd(Session::get('user_id'));
        // dd(date("Y-m-d H:i:s"));
        $data['UpdateID']   = Session::get('user_id');
        $data['UpdateDate'] = date("Y-m-d H:i:s");

        $data['state']         = isset($data['state']) ? $data['state'][0] : null;
        $data['DayNightLevel'] = isset($data['DayNightLevel']) ? $data['DayNightLevel'][0] : null;

        if ($act === 'save') {
            $result = tDayfg::updateOrCreate(array('DayfgID' => $id), $data);

            if ($result) {
                Session::flash('sweet', array('success', '儲存執行成功！'));
            } else {
                Session::flash('sweet', array('error', '儲存執行失敗！'));
            }
            return redirect()->route('a01120_view', array('edit', $result->DayfgID));

        } else {
            return view('ModuleNtue.NewStudent.regDayfg.view', array(
                'data'   => $data,
                'status' => $status,
            ));
        }
    }

}
