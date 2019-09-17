<?php

namespace App\Database\ACAD\tBhrStdRPData\Repo;

use App\Database\ACAD\ACADSysvar\Model\tACADSysvar;
use Illuminate\Support\Facades\DB;

class tBhrStdRPDataRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tBhrStdRPData";
        $this->Msg   = "獎懲建議明細";
    }

    public static function StuSetting($aParam = array())
    {
        //當前學年度的資料
        $sStudentNo = $aParam['sStudentNo'];
        $sYear      = tACADSysvar::where(array('var' => 'stu_year'))->first()->content;
        $sSemester  = tACADSysvar::where(array('var' => 'stu_semester'))->first()->content;

        $sWhere = ' b.StudentNo = ? AND a.Year = ? AND a.Semester = ? ';

        $aParam = array(
            $sStudentNo,
            $sYear,
            $sSemester,
        );

        $aField = array_keys(
            array(
                "b.StudentNo" => "學號",
                "b.ChtName"   => "姓名",
                "c.ClassName" => "班級",
                "a.StudentID" => "學生ID",
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = 'tStuStdClassHist';

        $sSql = "
        SELECT {$sSelect}
        FROM {$sTable} a
            LEFT JOIN tStudent b ON a.StudentID = b.StudentID
            LEFT JOIN tClass c ON a.ClassID = c.ClassID
        WHERE {$sWhere}";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    public static function tBhrStdRPDataSetting($aParam = array())
    {
        //第一次載入時直接查詢當前學年度的資料
        $sYear     = tACADSysvar::where(array('var' => 'stu_year'))->first()->content;
        $sSemester = tACADSysvar::where(array('var' => 'stu_semester'))->first()->content;

        $sStudentID    = $aParam['sStudentID'];
        $sACADYear_srh = isset($aParam['sACADYear_srh']) ? $aParam['sACADYear_srh'] : $sYear;
        $sSemester_srh = isset($aParam['sSemester_srh']) ? $aParam['sSemester_srh'] : $sSemester;

        $sWhere = ' d.StudentID = ? AND e.ACADYear = ? AND e.Semester = ? ';

        $aParam = array($sStudentID, $sACADYear_srh, $sSemester_srh);

        $aField = array_keys(
            array(
                "e.ACADYear"          => "學年",
                "e.Semester"          => "學期",
                "d.StudentID"         => "學生ID",
                "k.Clause"            => "條",
                "k.Article"           => "款",
                "k.Item"              => "項",
                "d.Memo"              => "事由",
                "d2.RPQty"            => "支數",
                "d2.BonusPenaltyPara" => "獎懲類別",
                "e.EliminateStatus"   => "銷過申請狀態",
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = 'tBhrStdRPData';

        $sSql = "
        SELECT {$sSelect}
        FROM {$sTable} a
            left join tBhrStdRPDataStu d on a.StdRPDataID = d.StdRPDataID
            left join tBhrStdRPDataReasonClass d2 on d.StdRPDataID = d2.StdRPDataID and d.StdRPDataStuID = d2.StdRPDataStuID
            left join tBhrRPReasonKind k on a.RPReasonKindID = k.RPReasonKindID
            left join tBhrStdEliminate e on d.StdRPDataStuID = e.StdRPDataStuID
        WHERE {$sWhere}
        ORDER BY e.ACADYear, e.Semester";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }
}
