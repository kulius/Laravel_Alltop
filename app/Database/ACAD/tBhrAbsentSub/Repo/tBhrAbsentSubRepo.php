<?php

namespace App\Database\ACAD\tBhrAbsentSub\Repo;

use App\Database\ACAD\ACADSysvar\Model\tACADSysvar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class tBhrAbsentSubRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tBhrAbsentSub";
        $this->Msg   = "請假扣分設定";
    }

    public static function AbsentSubSetting($aParam = array())
    {
        //第一次載入時直接查詢當前學年度的資料
        $sYear = tACADSysvar::where(array('var' => 'stu_year'))->first()->content;

        $sACADYear_srh    = isset($aParam['sACADYear_srh']) ? $aParam['sACADYear_srh'] : $sYear;
        $sSemester_srh    = isset($aParam['sSemester_srh']) ? $aParam['sSemester_srh'] : null;
        $sDayfg_srh       = isset($aParam['sDayfg_srh']) ? $aParam['sDayfg_srh'] : null;
        $sClassType_srh   = isset($aParam['sClassType_srh']) ? $aParam['sClassType_srh'] : null;
        $sMeetingKind_srh = isset($aParam['sMeetingKind_srh']) ? $aParam['sMeetingKind_srh'] : null;
        $sLeaveKind_srh   = isset($aParam['sLeaveKind_srh']) ? $aParam['sLeaveKind_srh'] : null;

        $sWhere = ' 1 = 1 ';

        $aParam = array();

        if ($sACADYear_srh) {
            $sWhere .= " AND a.ACADYear = ? ";
            $aParam[] = $sACADYear_srh;
        }
        if ($sSemester_srh) {
            $sWhere .= " AND a.Semester = ? ";
            $aParam[] = $sSemester_srh;
        }
        if ($sDayfg_srh) {
            $sWhere .= " AND a.DayfgID = ? ";
            $aParam[] = $sDayfg_srh;
        }
        if ($sClassType_srh) {
            $sWhere .= " AND a.ClassTypeID = ? ";
            $aParam[] = $sClassType_srh;
        }

        if ($sMeetingKind_srh) {
            $sWhere .= " AND a.MeetingKindID = ? ";
            $aParam[] = $sMeetingKind_srh;
        }

        if ($sLeaveKind_srh) {
            $sWhere .= " AND a.LeaveKindID = ? ";
            $aParam[] = $sLeaveKind_srh;
        }

        $aField = array_keys(
            array(
                "a.AbsentSubID"     => "扣分ID",
                "a.ACADYear"        => "學年",
                "a.Semester"        => "學期",
                "b.DayfgName"       => "部別",
                "c.ClassTypeName"   => "學制",
                "d.MeetingKindName" => "勤缺類別",
                'e.LeaveKindName'   => '請假類別',
                'a.SubModle'        => '扣分模式',
                'a.SubModleValue'   => '扣分數',
                'a.NoCountSection'  => '不列計節次',
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = 'tBhrAbsentSub';

        $sSql = "
        SELECT {$sSelect}
        FROM {$sTable} a
            LEFT JOIN tDayfg b ON a.DayfgID = b.DayfgID
            LEFT JOIN tClassType c ON a.ClassTypeID = c.ClassTypeID
            LEFT JOIN tBhrMeetingKind d ON a.MeetingKindID = d.MeetingKindID
            LEFT JOIN tBhrLeaveKind e ON a.LeaveKindID = e.LeaveKindID
        WHERE {$sWhere}
        ORDER BY a.ACADYear, a.Semester";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //複製上學期資料
    public static function CopyAbsentSub($aParam = array())
    {
        //取得當前學年學期
        $NowYear = tACADSysvar::where(array('var' => 'stu_year'))->first()->content;
        $NowSem  = tACADSysvar::where(array('var' => 'stu_semester'))->first()->content;

        //取得前學期
        if ($NowSem == '2') {
            $LastYear = $NowYear;
            $LastSem  = $NowSem - 1;
        } else {
            $LastYear = $NowYear - 1;
            $LastSem  = $NowSem + 1;
        }

        //取得建立者
        $ApplyID = Session::get('user_id');
        //$ApplyDate = date("Y-m-d H:i:s");

        $sTable = 'tBhrAbsentSub';

        //檢查前學期有沒有資料
        $sql = "
            SELECT COUNT(AbsentSubID)
            FROM {$sTable}
            WHERE ACADYear = '$LastYear' AND Semester = '$LastSem'
        ";

        $count = DB::connection('ACAD')->select($sql);

        if ($count[0][''] == '0') {
            return false;
        } else {
            $sSql = "
            INSERT INTO {$sTable}
            (AbsentSubID, ACADYear, Semester, DayfgID, ClassTypeID, MeetingKindID, LeaveKindID, SubModle, SubModleValue, NoCountSection, ApplyID, ApplyDate)
            SELECT NEWID(), '$NowYear', '$NowSem', DayfgID, ClassTypeID, MeetingKindID, LeaveKindID, SubModle, SubModleValue, NoCountSection, '$ApplyID', GETDATE()
            FROM {$sTable}
            WHERE ACADYear = '$LastYear' AND Semester = '$LastSem'
            ";

            return DB::connection('ACAD')->insert($sSql);
        }
    }

    //檢查資料是否重複

    public static function ChkAbsentSub($aParam = array())
    {
        // dd($aParam);
        $sACADYear      = isset($aParam['ACADYear']) ? $aParam['ACADYear'] : null;
        $sSemester      = isset($aParam['Semester']) ? $aParam['Semester'] : null;
        $sDayfgID       = isset($aParam['DayfgID']) ? $aParam['DayfgID'] : null;
        $sClassTypeID   = isset($aParam['ClassTypeID']) ? $aParam['ClassTypeID'] : null;
        $sMeetingKindID = isset($aParam['MeetingKindID']) ? $aParam['MeetingKindID'] : null;
        $sLeaveKindID   = isset($aParam['LeaveKindID']) ? $aParam['LeaveKindID'] : null;
        $sAbsentSubID   = isset($aParam['AbsentSubID']) ? $aParam['AbsentSubID'] : null;

        $sWhere = ' 1 = 1 ';
        $aParam = array();

        if ($sACADYear) {
            $sWhere .= " AND ACADYear = ? ";
            $aParam[] = $sACADYear;
        }

        if ($sSemester) {
            $sWhere .= " AND Semester = ? ";
            $aParam[] = $sSemester;
        }

        if ($sDayfgID) {
            $sWhere .= " AND DayfgID = ? ";
            $aParam[] = $sDayfgID;
        }

        if ($sClassTypeID) {
            $sWhere .= " AND ClassTypeID = ? ";
            $aParam[] = $sClassTypeID;
        }

        if ($sMeetingKindID) {
            $sWhere .= " AND MeetingKindID = ? ";
            $aParam[] = $sMeetingKindID;
        }

        if ($sLeaveKindID) {
            $sWhere .= " AND LeaveKindID = ? ";
            $aParam[] = $sLeaveKindID;
        }

        if ($sAbsentSubID) {
            $sWhere .= " AND AbsentSubID != ? ";
            $aParam[] = $sAbsentSubID;
        }

        $sTable = 'tBhrAbsentSub';

        $sSql = "
            SELECT count(*)
              FROM {$sTable}
             WHERE {$sWhere}
          ";

        $count = DB::connection('ACAD')->select($sSql, $aParam);

        return $count;
    }

    public static function UpdateAbsentSub($ACADYear, $Semester, $StudentID = null)
    {
        $sql = "
        --完整性確認
        EXEC usp_tBhrScoreIntegrityCheck '$ACADYear', '$Semester', '$StudentID'
        --全勤重算
        EXEC usp_UpdateTBhrScoreAllPresentAdd '$ACADYear', '$Semester', '$StudentID'
        --缺勤重算
        EXEC usp_UpdateTBhrScoreAbsentSub '$ACADYear', '$Semester', '$StudentID'
        --其他規則計算
        EXEC usp_UpdateTBhrScoreOthers '$ACADYear', '$Semester', '$StudentID'
        ";

        return DB::connection('ACAD')->select($sql);
    }
}
