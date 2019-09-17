<?php

namespace Modules\M07\Http\Controllers;

use App\Database\eOffice\tSysDemand\Model\tSysDemand;
use App\Database\eOffice\tSysDemand\Repo\tSysDemandRepo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class M07110Controller extends Controller
{
    public function __construct(tSysDemandRepo $Repo)
    {
        $this->Repo = $Repo;
    }

    //TODO  群組權限 1.撤單後一般使用者就看不到此單，但計中與先傑電腦仍可以查看到此單資料 2.一般使用者不可有「刪除」的功能 3.使用者對自已送出的需求單要可查可編輯
    public function index(Request $request)
    {
        App::setLocale('en');
        //狀態設為空
        session()->flash('status', '');

        //抓勾選checkbox
        $del = json_decode($request->tb_sel, true);

        //取的網頁狀態
        $event = $request->event;

        if ($del && $event == 'remove') {
            $ids_to_delete = array_map(function ($item) {return $item['ID'];}, $del);

            $result = tSysDemand::whereIn('ID', $ids_to_delete)->delete();

            if ($result) {
                Session::flash('sweet', array('success', '資料刪除成功！'));
            } else {
                Session::flash('sweet', array('error', '資料刪除失敗！'));
            }
        }

        //取得登入者帳號
        //$sLoginUser = Session::get('user_id');
        $sLoginUser = 'N224722534';

        //取得篩選欄位的值(非下拉)
        $sDemandNo_srh     = $request->get('DemandNo_srh');
        $sFiller_srh       = $request->get('Filler_srh');
        $sFillTimeStart    = $request->get('FillTimeStart');
        $sFillTimeEnd      = $request->get('FillTimeEnd');
        $sDemandTimeStart  = $request->get('DemandTimeStart');
        $sDemandTimeEnd    = $request->get('DemandTimeEnd');
        $sProcessReply_srh = $request->get('ProcessReply_srh');
        //下拉篩選取出陣列中的值
        $sFillUnit_srh       = $request->get('FillUnit_srh')[0];
        $sSystemName_srh     = $request->get('SystemName_srh')[0];
        $sFunctionName_srh   = $request->get('FunctionName_srh')[0];
        $sKind_srh           = $request->get('Kind_srh')[0];
        $sProcessStatus_srh  = $request->get('ProcessStatus_srh')[0];
        $sCompleteStatus_srh = $request->get('CompleteStatus_srh')[0];
        $sRange_srh          = $request->get('Range_srh')[0];

        //填報單位
        $aFillUnit = $this->Repo->FillUnit_Combo();
        //系統
        $aSystemName = $this->Repo->SystemName_Combo();
        //功能
        $aFunctionName = $this->Repo->FunctionName_Combo($sSystemName_srh);
        //分類
        $aKind = $this->Repo->Kind_Combo();
        //處理進度
        $aProcessStatus = $this->Repo->ProcessStatus_Combo(2);
        //處理進度
        $aCompleteStatus = $this->Repo->CompleteStatus_Combo();
        //查看範圍
        $aRange = $this->Repo->Range_Combo();

        //當畫刷新還能把下拉值保留
        $request->flash();

        //篩選條件傳到tSysDemandRepo去做資料篩選
        $data = tSysDemandRepo::DemandSetting(
            compact('sLoginUser', 'sDemandNo_srh', 'sFiller_srh', 'sFillTimeStart', 'sFillTimeEnd'
                , 'sDemandTimeStart', 'sDemandTimeEnd', 'sProcessReply_srh', 'sFillUnit_srh'
                , 'sSystemName_srh', 'sFunctionName_srh', 'sKind_srh', 'sProcessStatus_srh'
                , 'sCompleteStatus_srh', 'sRange_srh'
            )
        );

        return view('m07::m07110.index', array(
            'data'            => $data,
            'aFillUnit'       => $aFillUnit,
            'aSystemName'     => $aSystemName,
            'aFunctionName'   => $aFunctionName,
            'aKind'           => $aKind,
            'aProcessStatus'  => $aProcessStatus,
            'aCompleteStatus' => $aCompleteStatus,
            'aRange'          => $aRange,
        ));
    }

    public function view(Request $request, $status = null, $id = null)
    {
        //取得登入者帳號
        if ($status == 'add') {
            //$sLoginUser = Session::get('user_id');
            $sLoginUser = 'N224722534';
        } else {
            $sLoginUser = $request->get('PNO');
        }

        $userdata = tSysDemandRepo::LoginUserMes($sLoginUser);

        $data = tSysDemand::where('ID', '=', $id)->first();

        if ($status === 'add') {
            //系統(從查詢頁的下拉帶出)
            $SystemName = $request->get('SystemName');
        } else {
            $SystemName = $data["SystemName"];
        }

        //填報單位
        $aFillUnit = $this->Repo->FillUnit_Combo();
        //系統
        $aSystemName = $this->Repo->SystemName_Combo();
        //功能
        $aFunctionName = $this->Repo->FunctionName_Combo($SystemName);
        //分類
        $aKind = $this->Repo->Kind_Combo();
        //處理進度
        $aProcessStatus = $this->Repo->ProcessStatus_Combo(2);
        //處理進度
        $aCompleteStatus = $this->Repo->CompleteStatus_Combo();

        return view('m07::m07110.view', array(
            'vuserdata'       => $userdata,
            'vdata'           => $data,
            'status'          => $status,
            'sSystemName'     => $SystemName,
            'aFillUnit'       => $aFillUnit,
            'aSystemName'     => $aSystemName,
            'aFunctionName'   => $aFunctionName,
            'aKind'           => $aKind,
            'aProcessStatus'  => $aProcessStatus,
            'aCompleteStatus' => $aCompleteStatus,
        ));
    }

    public function save(Request $request, $status = null, $id = null)
    {
        $event = $request->get('event');

        $data = $request->all();

        $Num = tSysDemandRepo::SerialNum();
        //流水號組合
        $data['DemandNo'] = date('Y') - 1911 . date('m') . $Num;

        if ($status === 'add') {
            $data['ApplyID']      = Session::get('user_id');
            $data['ApplyDate']    = date("Y-m-d H:i:s");
            $data['DemandNo']     = date('Y') - 1911 . date('m') . $Num;
            $data['DrawalStatus'] = '0';
        } else {
            $data['CompleteStatus'] = $data['CompleteStatus'][0];
        }

        //異動者ID、異動時間
        $data['UpdateID']   = Session::get('user_id');
        $data['UpdateDate'] = date("Y-m-d H:i:s");

        $data['FunctionName'] = $data['FunctionName'][0];
        $data['Kind']         = $data['Kind'][0];
        // $data['ProcessStatus']  = $data['ProcessStatus'][0];

        if ($event === 'save') {
            $result = tSysDemand::updateOrCreate(array('ID' => $id), $data);

            if ($result) {
                Session::flash('sweet', array('success', '儲存執行成功！'));
            } else {
                Session::flash('sweet', array('error', '儲存執行失敗！'));
            }
            return redirect()->route('m07110_view', array('edit', $result->ID));
        } elseif ($event === 'ChgStatus') {
            //撤單
            $data['DrawalStatus'] = '1';

            $result = tSysDemand::updateOrCreate(array('ID' => $id), $data);

            if ($result) {
                Session::flash('sweet', array('success', '完成撤單！'));
                return redirect()->route('m07110');
            } else {
                Session::flash('sweet', array('error', '撤單失敗！'));
            }

            return redirect()->route('m07110_view', array('edit', $result->ID));
        } else {
            return view('m07::m07110.view', array(
                'data'   => $data,
                'status' => $status,
            ));
        }
    }
}
