<?php

namespace Modules\M04\Http\Controllers;

use App;
use App\Alltop\Combo;
use App\Database\ACAD\tEnrAdmitAmount\Model\tEnrAdmitAmount;
use App\Database\ACAD\tEnrAdmitAmount\Repo\tEnrAdmitAmountRepo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class M04170Controller extends Controller
{
    private $status;

    public function __construct(tEnrAdmitAmountRepo $tEnrAdmitAmountRepo, Combo $combo)
    {
        $this->Combo               = $combo;
        $this->tEnrAdmitAmountRepo = $tEnrAdmitAmountRepo;
    }
    //
    // public function index(Request $request)
    // {
    //     App::setLocale('en');

    //     //儲存按鈕
    //     $event    = $request->get('event');
    //     $sel_save = json_decode($request->UnitClassTypeYear_tb_ins_upd, true);

    //     if ($this->status === 'add') {
    //         $aRequest['ApplyID']   = Session::get('user_id');
    //         $aRequest['ApplyDate'] = date("Y-m-d H:i:s");
    //     }

    //     $sACADYear_srh   = $request->get('ACADYear_srh')[0];
    //     $sSemester_srh   = $request->get('Semester_srh')[0];
    //     $sDayfg_srh      = $request->get('Dayfg_srh')[0];
    //     $sClassType_srh  = $request->get('ClassType_srh')[0];
    //     $sCollege_srh    = $request->get('College_srh')[0];
    //     $sUnit_srh       = $request->get('Unit_srh')[0];
    //     $sStudyGroup_srh = $request->get('StudyGroup_srh')[0];
    //     $sEnrollType_srh = $request->get('EnrollType_srh')[0];

    //     //學年
    //     $aYear = $this->Combo->Year_combo($sACADYear_srh);
    //     //學期
    //     $aSemester = $this->Combo->Semester_combo();
    //     //部別
    //     $aDayfg = $this->Combo->Dayfg_combo();
    //     //學制
    //     $aClassType = $this->Combo->ClassType_combo($sDayfg_srh);
    //     //學院
    //     $aCollege = $this->Combo->College_combo(array('DayfgID' => $sDayfg_srh, 'ClassTypeID' => $sClassType_srh));
    //     //系所
    //     $aUnit = $this->Combo->Unit_combo(array('DayfgID' => $sDayfg_srh, 'ClassTypeID' => $sClassType_srh, 'CollegeID' => $sCollege_srh));
    //     //組別
    //     $aStudyGroup = $this->Combo->StudyGroup_combo(array('DayfgID' => $sDayfg_srh, 'ClassTypeID' => $sClassType_srh, 'UnitID' => $sUnit_srh));

    //     $aWhere = array();
    //     if (isset($request->Dayfg_srh[0])) {
    //         $aWhere[] = array("a.DayfgID = ?", $request->Dayfg_srh[0]);
    //     }
    //     if (isset($request->ClassType_srh[0])) {
    //         $aWhere[] = array("a.ClassTypeID = ?", $request->ClassType_srh[0]);
    //     }
    //     if (isset($request->College_srh[0])) {
    //         $aWhere[] = array("a.UnitID In (select UnitID from tUnitYear where upper=? and ACADYear=?)", array($request->College_srh[0], $request->ACADYear_srh[0]));
    //     }
    //     if (isset($request->Unit_srh[0])) {
    //         $aWhere[] = array("a.UnitID = ?", $request->Unit_srh[0]);
    //     }
    //     if (isset($request->StudyGroup_srh[0])) {
    //         $aWhere[] = array("a.StudyGroupID = ?", $request->StudyGroupID_srh[0]);
    //     }

    //     $data = $this->tEnrAdmitAmountRepo->read($aWhere);

    //     //保留原本所選取的資料
    //     $request->flash();

    //     return view('f05::F05720.index', array(
    //         'data'        => $data,
    //         'aYear'       => $aYear,
    //         'aSemester'   => $aSemester,
    //         'aDayfg'      => $aDayfg,
    //         'aClassType'  => $aClassType,
    //         'aCollege'    => $aCollege,
    //         'aUnit'       => $aUnit,
    //         'aStudyGroup' => $aStudyGroup,
    //     ));
    // }
    
    // public function view(Request $request, $status = null, $id = null)
    // {
    //     return view('f05::F05720.view', array(
    //         'status'   => $status,
    //     ));
    // }

    // public function view2(Request $request)
    // {
    //     return view('f05::F05720.view2', array(
    //         'current' => 0,
    //     ));
    // }
    // public function save(Request $request, $status = null, $id = null, tBhrSettleDateBatch $tBhrSettleDateBatch)
    // {
    //     $this->status = $status;
    //     $this->init($request->all());
    //     $sMode    = 'add';
    //     $aRoutePm = $status === 'add' ? array($status) : array($status, $id);

    //     if ($this->Event === 'save') {
    //         $id = isset($this->aPostData['SettleDateBatchID']) ? $this->aPostData['SettleDateBatchID'] : Common::checkGUID();

    //         if ($validator->fails()) {
    //             return redirect()->route('f05720_view', $aRoutePm)->withErrors($validator)->withInput();
    //         }

    //         $result = tBhrSettleDateBatch::updateOrCreate(array('SettleDateBatchID' => $id), $this->aPostData);
    //         if ($result) {
    //             Session::flash('sweet', array('success', '儲存執行成功！'));
    //             $sMode = 'edit';
    //         } else {
    //             Session::flash('sweet', array('error', '儲存執行失敗！'));
    //         }
    //         return redirect()->route('f05720_view', array(
    //             $sMode,
    //             $result->SettleDateBatchID,
    //         ));

    //     } else {
    //         return view('f05::F05720.index');
    //     }
    // }

    public function index(Request $request)
    {  
        $request->flash();
        $data = array(
            array("aa" => "1054778", "bb" => "李曉明", "cc" => "程式設計", "dd" => "3", "ee" => "3", "ff" => "3", "gg" => "3", "hh" => "3", "ii" => "3", "jj" => "3", "kk" => "3"),
            array("aa" => "1054778", "bb" => "李曉明", "cc" => "程式設計", "dd" => "3", "ee" => "3", "ff" => "3", "gg" => "3", "hh" => "3", "ii" => "3", "jj" => "3", "kk" => "3"),
        );
        return view('m04::M04170.index', array(
            'data'      => $data,
        ));
    }

    
    public function view(Request $request, $status = null, $id = null){
        
        return view('m04::M04170.view', array(
            'status' => $status,
        ));
    }

    
    
}
