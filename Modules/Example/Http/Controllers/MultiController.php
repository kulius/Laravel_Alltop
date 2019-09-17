<?php

namespace Modules\Example\Http\Controllers;

use App\Database\eOffice\SysMutiDetail\Model\tSysMutiDetail;
use App\Database\eOffice\SysMuti\Model\tSysMuti;
use App\Database\eOffice\SysMuti\Repo\tSysMutiRepo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MultiController extends Controller
{
    public function __construct(tSysMutiRepo $tSysMutiRepo)
    {
        $this->oSysMutiRepo = $tSysMutiRepo;
    }

    public function index()
    {
        // 清除Session
        if (Session::has('MutiID')) {
            Session::forget('MutiID');
            Session::forget('UpperStatus');
        }
        return view('example::Multi.index', array(
            'data' => $this->oSysMutiRepo->MutiControllerIndex(),
        ));
    }

    public function view1(Request $request, $status = null, $id = null)
    {
        if ($status != 'add') {
            // 主Key存入 session
            $request->session()->put('MutiID', $id);
            // 外層編輯狀態存入session
            $request->session()->put('UpperStatus', $status);
            $id = $request->session()->get('MutiID');
        }
        $data = tSysMuti::where('MutiID', $id)->first();

        return view('example::Multi.index_view1', array(
            'data'   => $data,
            'status' => $status,
            'id'     => $id,
        ));
    }

    public function view1_event(Request $request, $status = null, $id = null)
    {
        $event = $request->get('event');
        $data  = $request->all();

        if ($status == 'add') {
            $data['ApplyID']   = Session::get('user_id');
            $data['ApplyDate'] = date("Y-m-d H:i:s");
        }

        //異動者ID、異動時間
        $data['UpdateID']   = Session::get('user_id');
        $data['UpdateDate'] = date("Y-m-d H:i:s");

        if ($event === 'save') {
            $result = tSysMuti::updateOrCreate(array('MutiID' => $id), $data);

            if ($result) {
                Session::flash('sweet', array('success', '儲存執行成功！'));
            } else {
                Session::flash('sweet', array('error', '儲存執行失敗！'));
            }
            return redirect()->route('e00200_view1', array('edit', $result->MutiID));
        } else {
            return view('example::Multi.index_view1', array(
                'data'   => $data,
                'status' => $status,
            ));
        }
    }

    public function view2_index(Request $request, $status = null, $id = null)
    {
        $data = tSysMutiDetail::where('MutiID', $id)->get();

        return view('example::Multi.index_view2', array(
            'data'   => $data,
            'status' => $status,
            'id'     => $id,
        ));
    }

    public function view2(Request $request, $status = null, $id = null)
    {
        $UpperID     = $request->session()->get('MutiID');
        $UpperStatus = $request->session()->get('UpperStatus');
        $data        = tSysMutiDetail::where('DetailID', $id)->first();

        return view('example::Multi.index_view2_edit', array(
            'data'        => $data,
            'status'      => $status,
            'id'          => $id,
            'UpperID'     => $UpperID,
            'UpperStatus' => $UpperStatus,
        ));
    }

    public function view2_event(Request $request, $status = null, $id = null)
    {
        $event = $request->get('event');
        $data  = $request->all();

        if ($status == 'add') {
            $data['ApplyID']   = Session::get('user_id');
            $data['ApplyDate'] = date("Y-m-d H:i:s");
        }

        //異動者ID、異動時間
        $data['MutiID']     = $request->session()->get('MutiID');
        $data['UpdateID']   = Session::get('user_id');
        $data['UpdateDate'] = date("Y-m-d H:i:s");

        if ($event === 'save') {
            $result = tSysMutiDetail::updateOrCreate(array('DetailID' => $id), $data);

            if ($result) {
                Session::flash('sweet', array('success', '儲存執行成功！'));
            } else {
                Session::flash('sweet', array('error', '儲存執行失敗！'));
            }
            return redirect()->route('e00200_view2', array('edit', $result->DetailID));
        } else {
            return view('example::Multi.index_view2_edit', array(
                'data'   => $data,
                'status' => $status,
            ));
        }
    }

}
