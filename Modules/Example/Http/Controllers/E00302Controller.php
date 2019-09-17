<?php

namespace Modules\Example\Http\Controllers;

use App;
use App\Alltop\BaseModel;
use App\Alltop\Combo;
use App\Alltop\Common;
use App\Alltop\JumpHandler;
use App\Database\ACAD\ACADSysvar\Model\tACADSysvar;
use App\Database\ACAD\tBhrLeaveKind\Repo\tBhrLeaveKindRepo;
use App\Database\ACAD\tBhrMeetingKind\Model\tBhrMeetingKind;
use App\Database\ACAD\tBhrStdAbsentDetail\Model\tBhrStdAbsentDetail;
use App\Database\ACAD\tBhrStdAbsent\Model\tBhrStdAbsent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use View;

class E00302Controller extends Controller
{
    private $oCombo;
    private $tBhrLeaveKindRepo;

    public function __construct()
    {
        App::setLocale('en');
        $this->oCombo            = new Combo();
        $this->tBhrLeaveKindRepo = new tBhrLeaveKindRepo();
    }

    // TODO: 表單驗證
    public function validateData($aData = null)
    {
        //驗證規則請參考 https://laravel.com/docs/5.8/validation#available-validation-rules
        $rules = array(
            'StudentID'    => 'required',
            'LeaveKindID'  => 'required',
            'LeaveDateBeg' => 'required',
            'LeaveDateEnd' => 'required',
            'LeaveReason'  => 'required',
        );
        $messages = array(
            'StudentID'    => ':attribute 欄資料不是數字', //:attribute => Html 的 name
            'LeaveKindID'  => ':attribute 欄資料為必填',
            'LeaveDateBeg' => ':attribute 欄資料不是email',
        );

        //傳入的aData必須是array() 且 要與 $rules 陣列對應 key value
        // $rules = array('name' => 'required'), $aData = array('name' => 'Neo');
        $oValidator = Validator::make($aData, $rules, $messages);
        if ($oValidator->fails()) {
            //失敗看要做什麼，取出失敗的訊息
            $customMsg = $oValidator->messages();
            //或者直接中斷程式，直接返回錯誤訊息到畫面，畫面需要另外加上顯示錯誤的模板
            return redirect()->back()->withErrors($oValidator->errors());
        }
        return true;
    }

    // 學生請假資料明細頁
    public function index(Request $request)
    {
        $aRequest = $request->all();
        $event    = isset($aRequest['event']) ? $aRequest['event'] : null;

        if ($request->has('srh')) {
            Session::put('srh', $request->get('srh'));
        } else {
            $request->request->set('srh', Session::pull('srh'));
        }
        $request->flash();

        if ($event === 'remove') {
            $aDel = json_decode($aRequest["tb_sel"], true);
            if ($aDel) {
                $source = array_map(function ($item) {return $item['StdAbsentID'];}, $aDel);
                $tBhrStdAbsent       = tBhrStdAbsent::whereIn('StdAbsentID', $source)->delete();
                $tBhrStdAbsentDetail = tBhrStdAbsentDetail::whereIn('StdAbsentID', $source)->delete();
            }
            if ($tBhrStdAbsent && $tBhrStdAbsentDetail) {
                Session::flash('sweet', array('success', '刪除執行成功！'));
            } else {
                Session::flash('sweet', array('error', '刪除執行失敗！'));
            }
        }

        $Year  = tACADSysvar::where(array('var' => 'stu_year'))->first()->content;
        $Sem   = tACADSysvar::where(array('var' => 'stu_semester'))->first()->content;
        $sYear = Common::VarPriority(array('index' => 'ACADYear', 'def' => $Year));
        $sSem  = Common::VarPriority(array('index' => 'Semester', 'def' => $Sem));

        $YearOp = $this->oCombo->Year_Combo($sYear);
        $SemOp  = $this->oCombo->Semester_combo();

        $aAllOption = array(array('value' => '', 'text' => '全選'));

        $DfgOp    = array_merge($aAllOption, $this->oCombo->Dayfg_combo());
        $sDayfgID = Common::VarPriority(array('index' => 'DayfgID', 'def' => isset($DfgOp[0]['value']) ? $DfgOp[0]['value'] : ''));

        $ClassTypeOp  = array_merge($aAllOption, $this->oCombo->ClassType_combo($sDayfgID));
        $sClassTypeID = Common::VarPriority(array('index' => 'ClassTypeID', 'def' => isset($ClassTypeOp[0]['value']) ? $ClassTypeOp[0]['value'] : ''));

        $CollegeOp  = array_merge($aAllOption, $this->oCombo->College_combo(array('DayfgID' => $sDayfgID, 'ClassTypeID' => $sClassTypeID)));
        $sCollegeID = Common::VarPriority(array('index' => 'CollegeID', 'def' => isset($CollegeOp[0]['value']) ? $CollegeOp[0]['value'] : ''));

        $UnitOp  = array_merge($aAllOption, $this->oCombo->UnitYear_combo(array('ACADYear' => $sYear, 'DayfgID' => $sDayfgID, 'ClassTypeID' => $sClassTypeID, 'CollegeID' => $sCollegeID)));
        $sUnitID = Common::VarPriority(array('index' => 'UnitID', 'def' => isset($UnitOp[0]['value']) ? $UnitOp[0]['value'] : ''));

        $GroupOp  = array_merge($aAllOption, $this->oCombo->StudyGroup_combo(array('DayfgID' => $sDayfgID, 'ClassTypeID' => $sClassTypeID, 'UnitID' => $sUnitID)));
        $sGroupID = Common::VarPriority(array('index' => 'GroupID', 'def' => isset($GroupOp[0]['value']) ? $GroupOp[0]['value'] : ''));

        $GradeOp = array_merge($aAllOption, $this->oCombo->Grade_combo(array('DayfgID' => $sDayfgID, 'ClassTypeID' => $sClassTypeID, 'UnitID' => $sUnitID)));
        $sGrade  = Common::VarPriority(array('index' => 'Grade', 'def' => isset($GradeOp[0]['value']) ? $GradeOp[0]['value'] : ''));

        $ClassOp  = array_merge($aAllOption, $this->oCombo->Class_combo(array('DayfgID' => $sDayfgID, 'ClassTypeID' => $sClassTypeID, 'UnitID' => $sUnitID, 'Grade' => $sGrade)));
        $sClassID = Common::VarPriority(array('index' => 'ClassID', 'def' => isset($ClassOp[0]['value']) ? $ClassOp[0]['value'] : ''));

        $sStudentNo = Common::VarPriority(array('index' => 'StudentNo'));
        $sChtName   = Common::VarPriority(array('index' => 'ChtName'));

        $SingStatusOp = array(
            array('value' => '', 'text' => '全部'),
            array('value' => 0, 'text' => '未送出'),
            array('value' => 1, 'text' => '流程中'),
            array('value' => 2, 'text' => '退回'),
            array('value' => 3, 'text' => '不通過'),
            array('value' => 4, 'text' => '已通過'),
        );
        $sStatus = Common::VarPriority(array('index' => 'SingStatus', 'def' => ''));

        $sLeaveDateBeg = Common::VarPriority(array('index' => 'LeaveDateBeg'));
        $sLeaveDateEnd = Common::VarPriority(array('index' => 'LeaveDateEnd'));
        $aWhere        = array();

        if ($sYear) {
            $aWhere[] = array('a.ACADYear = ?', $sYear);
        }
        if ($sSem) {
            $aWhere[] = array('a.Semester = ?', $sSem);
        }
        if ($sDayfgID) {
            $aWhere[] = array('d.DayfgID = ?', $sDayfgID);
        }
        if ($sClassTypeID) {
            $aWhere[] = array('d.ClassTypeID = ?', $sClassTypeID);
        }
        if ($sUnitID) {
            $aWhere[] = array('d.UnitID = ?', $sUnitID);
        }
        if ($sGroupID) {
            $aWhere[] = array('d.StudyGroupID = ?', $sGroupID);
        }
        if ($sGrade) {
            $aWhere[] = array('d.Grade = ?', $sGrade);
        }
        if ($sClassID) {
            $aWhere[] = array('d.ClassID = ?', $sClassID);
        }
        if ($sStatus != '') {
            $aWhere[] = array('a.status = ?', $sStatus);
        }
        if ($sLeaveDateBeg) {
            $aWhere[] = array('a.LeaveDateBeg > ?', $sLeaveDateBeg);
        }
        if ($sLeaveDateEnd) {
            $aWhere[] = array('a.LeaveDateEnd < ?', $sLeaveDateEnd);
        }
        if ($sStudentNo) {
            $aWhere[] = array('c.StudentNo LIKE ?', '%' . $sStudentNo . '%');
        }
        if ($sChtName) {
            $aWhere[] = array('c.ChtName LIKE ?', '%' . $sChtName . '%');
        }

        $aWhereInfo = BaseModel::setWhere($aWhere);

        if ($sCollegeID) {
            $aWhereInfo['where'] .= ' AND d.UnitID IN (SELECT UnitID FROM tUnit WHERE upper = ?)';
            $aWhereInfo['param'][] = $sCollegeID;
        }
        $sGroupBy = ' GROUP BY a.StdAbsentID, c.StudentNo, c.ChtName, e.ClassName, f.LeaveKindName, a.LeaveReason, a.LeaveDateBeg, a.LeaveDateEnd, a.status';

        $sSql = "SELECT a.StdAbsentID, c.StudentNo, c.ChtName, e.ClassName, f.LeaveKindName, a.LeaveReason
                      , CAST(a.LeaveDateBeg AS NVARCHAR) + ' ~ ' + CAST(a.LeaveDateEnd AS NVARCHAR) AS AbsentSEDate
                      , COUNT(b.SectionSeq) AS SectionSeqCount, a.status
                 FROM tBhrStdAbsent a
                 INNER JOIN tBhrStdAbsentDetail b ON a.StdAbsentID = b.StdAbsentID
                 INNER JOIN vStuStudentAll c ON a.StudentID = c.StudentID
                 INNER JOIN tStuStdClassHist d ON c.StudentID = d.StudentID AND a.ACADYear = d.Year AND a.Semester = d.Semester
                 INNER JOIN tClass e ON d.ClassID = e.ClassID
                 INNER JOIN tBhrLeaveKind f ON a.LeaveKindID = f.LeaveKindID
                 WHERE " . $aWhereInfo['where'] . $sGroupBy;

        $data = DB::connection('ACAD')->select($sSql, $aWhereInfo['param']);
        return view('example::e00302.index', array(
            'data'          => $data,
            'sYear'         => $sYear,
            'sSem'          => $sSem,
            'sDayfgID'      => $sDayfgID,
            'sClassTypeID'  => $sClassTypeID,
            'sCollegeID'    => $sCollegeID,
            'sUnitID'       => $sUnitID,
            'sGroupID'      => $sGroupID,
            'sGrade'        => $sGrade,
            'sClassID'      => $sClassID,
            'sStudentNo'    => $sStudentNo,
            'sChtName'      => $sChtName,
            'sStatus'       => $sStatus,
            'sLeaveDateBeg' => $sLeaveDateBeg,
            'sLeaveDateEnd' => $sLeaveDateEnd,
            'YearOp'        => $YearOp,
            'SemOp'         => $SemOp,
            'DfgOp'         => $DfgOp,
            'ClassTypeOp'   => $ClassTypeOp,
            'CollegeOp'     => $CollegeOp,
            'UnitOp'        => $UnitOp,
            'GroupOp'       => $GroupOp,
            'GradeOp'       => $GradeOp,
            'ClassOp'       => $ClassOp,
            'SingStatusOp'  => $SingStatusOp,
        ));
    }

    // 編輯頁
    public function view(Request $request, $status = null, $id = null)
    {
        $DbCon = DB::connection('ACAD');
        $Year  = tACADSysvar::where(array('var' => 'stu_year'))->first()->content;
        $Sem   = tACADSysvar::where(array('var' => 'stu_semester'))->first()->content;

        // Key
        $StdAbsentID = isset($id) ? $id : null;
        // 請假單資料
        $tBhrStdAbsentData = tBhrStdAbsent::where('StdAbsentID', '=', $StdAbsentID)->first();

        $sYear        = Common::FormVarPriority(array('status' => $status, 'def' => $Year, 'post' => 'ACADYear', 'dbval' => $tBhrStdAbsentData['ACADYear']));
        $sSem         = Common::FormVarPriority(array('status' => $status, 'def' => $Sem, 'post' => 'Semester', 'dbval' => $tBhrStdAbsentData['Semester']));
        $StudentID    = Common::FormVarPriority(array('status' => $status, 'def' => null, 'post' => 'StudentID', 'dbval' => $tBhrStdAbsentData['StudentID']));
        $StudentNo    = Common::FormVarPriority(array('status' => $status, 'def' => $this->getStudentNo($StudentID), 'post' => 'StudentNo', 'dbval' => $this->getStudentNo($StudentID)));
        $LeaveDateBeg = Common::FormVarPriority(array('status' => $status, 'def' => null, 'post' => 'LeaveDateBeg', 'dbval' => $tBhrStdAbsentData['LeaveDateBeg']));
        $LeaveDateEnd = Common::FormVarPriority(array('status' => $status, 'def' => null, 'post' => 'LeaveDateEnd', 'dbval' => $tBhrStdAbsentData['LeaveDateEnd']));
        $LeaveKindID  = Common::FormVarPriority(array('status' => $status, 'def' => null, 'post' => 'LeaveKindID', 'dbval' => $tBhrStdAbsentData['LeaveKindID']));
        $ApplyDate    = Common::FormVarPriority(array('status' => $status, 'def' => date('Y-m-d'), 'post' => 'ApplyDate', 'dbval' => $tBhrStdAbsentData['ApplyDate']));
        $ChtName      = Common::FormVarPriority(array('status' => $status, 'def' => null, 'post' => 'ChtName', 'dbval' => $this->getStuName($StudentID)));
        $ClassName    = Common::FormVarPriority(array('status' => $status, 'def' => null, 'post' => 'ClassName', 'dbval' => $this->getStuClassName($sYear, $sSem, $StudentID)));
        $LeaveReason  = Common::FormVarPriority(array('status' => $status, 'def' => null, 'post' => 'LeaveReason', 'dbval' => $tBhrStdAbsentData['LeaveReason']));
        $sStatus      = Common::FormVarPriority(array('status' => $status, 'def' => '1', 'post' => '', 'dbval' => $tBhrStdAbsentData['status']));

        // 彈跳下拉Option處理
        $StudentOption = array(array('text' => $StudentNo, 'value' => $StudentID));

        // 產生請假日期節次勾選Grid
        if (!is_null($LeaveDateBeg) && !is_null($LeaveDateEnd)) {
            // 已請假節次
            $aDbStuAbSection = $DbCon->table('tBhrStdAbsentDetail')->where('StdAbsentID', '=', $StdAbsentID)->select('AbsentDate', 'SectionSeq')->orderBy('AbsentDate')->orderBy('SectionSeq')->get()->toArray();
            /* 將二維陣列處理為一維陣列 */
            $index = 0;
            $pre   = '';
            foreach ($aDbStuAbSection as $key => $value) {
                // 如果當前不等於前一個key，重設index
                if ($value['AbsentDate'] != $pre) {
                    $index = 0;
                    $pre   = $value['AbsentDate'];
                } else {
                    $index++;
                }
                $aStuAbSection[$value['AbsentDate']][$index] = $value['SectionSeq'];
            }
            // 節次資料
            $aSection = $DbCon->table('tCusSection')->select('SectionSeq AS value', 'SectionName AS text')->orderBy('Seq')->get();
            // 算出有機天
            $nRangeDay = (int) round((strtotime($LeaveDateEnd) - strtotime($LeaveDateBeg)) / 3600 / 24);
            for ($y = 0, $l = count($aSection); $y < $l; $y++) {
                $AbsentSection[$y] = array('text' => $aSection[$y]['text'], 'value' => $aSection[$y]['value']);
            }

            for ($x = 0; $x <= $nRangeDay; $x++) {
                $index = date('Y-m-d', strtotime('+' . $x . ' day', strtotime($LeaveDateBeg)));
                // 天數加所有節次的陣列
                $aAbsentSection[$index] = $AbsentSection;
            }

            // 學生選擇的日期節次資料寫入session
            if (isset($aStuAbSection)) {
                $request->session()->flash('StuSectionSeq', $aStuAbSection);
            }
            // 日期節次資料寫入session
            $request->session()->flash('SectionBlock', $aAbsentSection);
        }
        // 是否顯示附件上傳區塊
        if (!is_null($LeaveKindID)) {
            $data      = $DbCon->table('tBhrLeaveKind')->where('LeaveKindID', '=', $LeaveKindID)->select('IsUpload')->get()->toArray();
            $bIsUpload = isset($data[0]['IsUpload']) ? $data[0]['IsUpload'] : 0;
            // 將布林直寫入session
            $request->session()->flash('IsUpload', $bIsUpload);
        }
        // 彈跳下拉資料存取
        if (isset($StudentID)) {
            $request->session()->flash('StudentID', $StudentID);
            $request->session()->flash('StudentNo', $StudentNo);
        }
        // 假別下拉選項
        $LeaveKindOption = array_merge(array(array("text" => "", "value" => "")), $this->tBhrLeaveKindRepo->LeaveKindOption());
        return view('example::e00302.view', array(
            'status'          => $status,
            'StdAbsentID'     => $StdAbsentID,
            'sYear'           => $sYear,
            'sSem'            => $sSem,
            'StudentID'       => $StudentID,
            'StudentNo'       => $StudentNo,
            'ChtName'         => $ChtName,
            'ClassName'       => $ClassName,
            'LeaveDateBeg'    => $LeaveDateBeg,
            'LeaveDateEnd'    => $LeaveDateEnd,
            'LeaveKindID'     => $LeaveKindID,
            'LeaveReason'     => $LeaveReason,
            'ApplyDate'       => $ApplyDate,
            'sStatus'         => $sStatus,
            'LeaveKindOption' => $LeaveKindOption,
            'StudentOption'   => $StudentOption,
        ));
    }

    // 選擇學生彈跳視窗
    public function StuSel(Request $request)
    {
        if ($request->has('srh')) {
            Session::put('srh', $request->get('srh'));
        }

        $Year  = tACADSysvar::where(array('var' => 'stu_year'))->first()->content;
        $Sem   = tACADSysvar::where(array('var' => 'stu_semester'))->first()->content;
        $sYear = Common::VarPriority(array('index' => 'ACADYear', 'def' => $Year));
        $sSem  = Common::VarPriority(array('index' => 'Semester', 'def' => $Sem));

        $YearOp   = $this->oCombo->Year_Combo($sYear);
        $SemOp    = $this->oCombo->Semester_combo();
        $DfgOp    = $this->oCombo->Dayfg_combo();
        $sDayfgID = Common::VarPriority(array('index' => 'DayfgID', 'def' => $DfgOp[0]['value']));

        $aAllOption = array(array('value' => '', 'text' => '全選'));

        $DfgOp    = array_merge($aAllOption, $this->oCombo->Dayfg_combo());
        $sDayfgID = Common::VarPriority(array('index' => 'DayfgID', 'def' => isset($DfgOp[0]['value']) ? $DfgOp[0]['value'] : ''));

        $ClassTypeOp  = array_merge($aAllOption, $this->oCombo->ClassType_combo($sDayfgID));
        $sClassTypeID = Common::VarPriority(array('index' => 'ClassTypeID', 'def' => isset($ClassTypeOp[0]['value']) ? $ClassTypeOp[0]['value'] : ''));

        $CollegeOp  = array_merge($aAllOption, $this->oCombo->College_combo(array('DayfgID' => $sDayfgID, 'ClassTypeID' => $sClassTypeID)));
        $sCollegeID = Common::VarPriority(array('index' => 'CollegeID', 'def' => isset($CollegeOp[0]['value']) ? $CollegeOp[0]['value'] : ''));

        $UnitOp  = array_merge($aAllOption, $this->oCombo->UnitYear_combo(array('ACADYear' => $sYear, 'DayfgID' => $sDayfgID, 'ClassTypeID' => $sClassTypeID, 'CollegeID' => $sCollegeID)));
        $sUnitID = Common::VarPriority(array('index' => 'UnitID', 'def' => isset($UnitOp[0]['value']) ? $UnitOp[0]['value'] : ''));

        $GroupOp  = array_merge($aAllOption, $this->oCombo->StudyGroup_combo(array('DayfgID' => $sDayfgID, 'ClassTypeID' => $sClassTypeID, 'UnitID' => $sUnitID)));
        $sGroupID = Common::VarPriority(array('index' => 'GroupID', 'def' => isset($GroupOp[0]['value']) ? $GroupOp[0]['value'] : ''));

        $GradeOp = array_merge($aAllOption, $this->oCombo->Grade_combo(array('DayfgID' => $sDayfgID, 'ClassTypeID' => $sClassTypeID, 'UnitID' => $sUnitID)));
        $sGrade  = Common::VarPriority(array('index' => 'Grade', 'def' => isset($GradeOp[0]['value']) ? $GradeOp[0]['value'] : ''));

        $ClassOp  = array_merge($aAllOption, $this->oCombo->Class_combo(array('DayfgID' => $sDayfgID, 'ClassTypeID' => $sClassTypeID, 'UnitID' => $sUnitID, 'Grade' => $sGrade)));
        $sClassID = Common::VarPriority(array('index' => 'ClassID', 'def' => isset($ClassOp[0]['value']) ? $ClassOp[0]['value'] : ''));

        $aParams = array();
        $sWhere  = '';

        $sWhere .= ' WHERE b.Year = ?';
        $aParams[] = $sYear;
        $sWhere .= ' AND b.Semester = ?';
        $aParams[] = $sSem;

        if (isset($_POST['srh'])) {
            if ($_POST['srh']['DayfgID'][0]) {
                $sWhere .= ' AND b.DayfgID = ?';
                $aParams[] = $sDayfgID;
            }

            if ($_POST['srh']['ClassTypeID'][0]) {
                $sWhere .= ' AND b.ClassTypeID = ?';
                $aParams[] = $sClassTypeID;
            }

            if ($_POST['srh']['CollegeID'][0]) {
                $sWhere .= ' AND b.UnitID IN (SELECT UnitID FROM tUnit WHERE upper = ?)';
                $aParams[] = $sCollegeID;
            }

            if ($_POST['srh']['UnitID'][0]) {
                $sWhere .= ' AND b.UnitID = ?';
                $aParams[] = $sUnitID;
            }

            if ($_POST['srh']['GroupID'][0]) {
                $sWhere .= ' AND b.StudyGroupID = ?';
                $aParams[] = $sGroupID;
            }

            if ($_POST['srh']['Grade'][0]) {
                $sWhere .= ' AND b.Grade = ?';
                $aParams[] = $sGrade;
            }

            if ($_POST['srh']['ClassID'][0]) {
                $sWhere .= ' AND b.ClassID = ?';
                $aParams[] = $sClassID;
            }
        }
        $sSql = 'SELECT DISTINCT a.StudentID, a.StudentNo, a.ChtName
                 FROM vStuStudentAll a
                 INNER JOIN tStuStdClassHist b ON a.StudentID = b.StudentID
                 INNER JOIN tUnitClassType c ON b.DayfgID = c.DayfgID AND b.ClassTypeID = c.ClassTypeID AND b.UnitID = c.UnitID' . $sWhere;

        $aModel = DB::connection('ACAD')->select($sSql, $aParams);

        $aJumpSel = json_decode($request->StuSel_tb_sel, true);
        if ($request->event == 'select') {
            $sScript = JumpHandler::setJumpSelData(array(
                'name'  => 'StudentID', // dropbox 的 name
                "data"  => $aJumpSel,
                "value" => "StudentID",        //要帶回到 dropbox 的 key 值
                "text"  => array("StudentNo"), //要顯示在 dropbox 上的名稱, $aJumpSel[0]['data']
            ));
            //直接回傳 Js Script
            return $sScript;
        }
        return view('example::e00302.StuSel', array(
            'aModel'       => $aModel,
            'sYear'        => $sYear,
            'sSem'         => $sSem,
            'sDayfgID'     => $sDayfgID,
            'sClassTypeID' => $sClassTypeID,
            'sCollegeID'   => $sCollegeID,
            'sUnitID'      => $sUnitID,
            'sGroupID'     => $sGroupID,
            'sGrade'       => $sGrade,
            'sClassID'     => $sClassID,
            'YearOp'       => $YearOp,
            'SemOp'        => $SemOp,
            'DfgOp'        => $DfgOp,
            'ClassTypeOp'  => $ClassTypeOp,
            'CollegeOp'    => $CollegeOp,
            'UnitOp'       => $UnitOp,
            'GroupOp'      => $GroupOp,
            'GradeOp'      => $GradeOp,
            'ClassOp'      => $ClassOp,
        ));
    }

    // 此畫面的post動作處理
    public function event(Request $request, $status = null, $id = null)
    {
        $request->flash();
        $aRequest = $request->all();
        $event    = isset($aRequest['event']) ? $aRequest['event'] : '';

        // [儲存並送出]、[儲存並決行]動作處理
        if ($event === 'save' || $event === 'excute') {
            // TODO: 儲存驗證判斷
            if ($event === 'save') {
                $AbsentStatus = 2;
            } else {
                $AbsentStatus = 1;
            }
            $aAbsentData = array(
                'ACADYear'     => $aRequest['ACADYear'],
                'Semester'     => $aRequest['Semester'],
                'AbsentDate'   => $aRequest['AbsentDate'],
                'StudentID'    => $aRequest['StudentID'][0],
                'LeaveKindID'  => $aRequest['LeaveKindID'][0],
                'LeaveReason'  => $aRequest['LeaveReason'],
                'LeaveDateBeg' => $aRequest['LeaveDateBeg'],
                'LeaveDateEnd' => $aRequest['LeaveDateEnd'],
                'FormNo'       => '',
                'status'       => $AbsentStatus,
            );
            $tBhrStdAbsent = tBhrStdAbsent::updateOrCreate(array('StdAbsentID' => $id), $aAbsentData);

            $MeetingKind = tBhrMeetingKind::where('MeetingKindName', '=', '課程')->get()->toArray();
            if (count($MeetingKind) > 0) {
                $MeetingKindID = $MeetingKind[0]['MeetingKindID'];
            }

            if ($status === 'edit') {
                // 先刪除明細
                tBhrStdAbsentDetail::whereIn('StdAbsentID', array($id))->delete();
            }
            $nRangeDay = (int) round((strtotime($aRequest['LeaveDateEnd']) - strtotime($aRequest['LeaveDateBeg'])) / 3600 / 24);
            for ($x = 0; $x <= $nRangeDay; $x++) {
                $AbsentDate = date('Y-m-d', strtotime('+' . $x . ' day', strtotime($aRequest['LeaveDateBeg'])));
                $index      = 'Section_' . $AbsentDate;
                foreach ($aRequest[$index] as $Section) {
                    $aAbsentDetailData = array(
                        'StdAbsentID'   => $tBhrStdAbsent->StdAbsentID,
                        'AbsentDate'    => $AbsentDate,
                        'SectionSeq'    => $Section,
                        'MeetingKindID' => $MeetingKindID,
                    );
                    // 新增明細
                    $tBhrStdAbsentDetail = tBhrStdAbsentDetail::updateOrCreate(array('StdAbsentDetailID' => $id), $aAbsentDetailData);
                }
            }

            /*
            // TODO: 檔案上傳未完成
            $file = $data['AbsentFile'];
            // 原始檔名
            $FileName = $file->getClientOriginalName();
            // 儲存的檔名
            $fileName = $id . '.' . $file->getClientOriginalExtension();
            // 檔案類型
            $FileType = $file->getClientMimeType();
            // 檔案大小
            $FileSize = $file->getClientSize();

            // 驗證格式
            $rules         = array('AbsentFile' => array('file'));
            $FileValidator = Validator::make($data, $rules, $messages);

            if ($FileValidator->fails()) {
            return redirect()->route('e00302_view', array($status, $id))->withErrors($FileValidator);
            };

            $directoryName = 'C:/UPLOAD/F01/' . $id;

            //建立資料夾
            if (!is_dir($directoryName)) {
            mkdir($directoryName, 0755, true);
            }
            $Path = str_replace('/', "\\\\", $directoryName);

            $files = tITFILE::create(
            array('formid' => 'E01',
            'file_name'    => $FileName,
            'file_type'    => $FileType,
            'file_size'    => $FileSize,
            'file_encode'  => '',
            'file_path'    => $directoryName,
            'ins_userid'   => Session::get('user_id'),
            )
            );

            //儲存檔案
            $file->move($Path, $FileName);
             */
            if ($tBhrStdAbsent && $tBhrStdAbsentDetail) {
                Session::flash('sweet', array('success', '儲存執行成功！'));
                $status = 'edit';
            } else {
                Session::flash('sweet', array('error', '儲存執行失敗！'));
            }
            return redirect()->route('e00302_view', array(
                $status,
                $tBhrStdAbsent->StdAbsentID,
            ));
        } else {
            // 重載畫面
            return $this->view($request, $status, $id);
        }
    }

    // 取得學生姓名、班級名稱
    public function getStuInfo(Request $request)
    {
        $aRequest = $request->all('StudentID', 'sYear', 'sSem');
        $data     = DB::connection('ACAD')->table('vStuStudentAll AS a')
                                          ->join('tStuStdClassHist AS b', 'a.StudentID', '=', 'b.StudentID')
                                          ->join('tClass AS c', 'b.ClassID', '=', 'c.ClassID')
                                          ->select('a.ChtName', 'c.ClassName')
                                          ->where(array(
                                              array('a.StudentID', '=', $aRequest['StudentID']),
                                              array('b.Year', '=', $aRequest['sYear']),
                                              array('b.Semester', '=', $aRequest['sSem'])))->get();
        return $data;
    }

    // 取得學生學號
    public function getStudentNo($StudentID)
    {
        $data = DB::connection('ACAD')->table('vStuStudentAll')->select('StudentNo')->where('StudentID', '=', $StudentID)->get()->toArray();
        return count($data) > 0 ? $data[0]['StudentNo'] : '';
    }

    // 取得學生姓名
    public function getStuName($StudentID)
    {
        $data = DB::connection('ACAD')->table('vStuStudentAll')->select('ChtName')->where('StudentID', '=', $StudentID)->get()->toArray();
        return count($data) > 0 ? $data[0]['ChtName'] : '';
    }

    // 取得學生班級
    public function getStuClassName($sYear, $sSem, $StudentID)
    {
        $data = DB::connection('ACAD')->table('tStuStdClassHist AS a')
                                      ->join('tClass AS b', 'a.ClassID', '=', 'b.ClassID')
                                      ->select('b.ClassName')
                                      ->where(array(
                                          array('a.StudentID', '=', $StudentID),
                                          array('a.Year', '=', $sYear),
                                          array('a.Semester', '=', $sSem)))->get()->toArray();

        return count($data) > 0 ? $data[0]['ClassName'] : '';

    }
}
