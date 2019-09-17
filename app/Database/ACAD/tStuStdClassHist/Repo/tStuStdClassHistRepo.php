<?php

namespace App\Database\ACAD\tStuStdClassHist\Repo;

use App\Database\ACAD\tStuStdClassHist\Model\tStuStdClassHist;
use Illuminate\Support\Facades\DB;

class tStuStdClassHistRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tStuStdClassHist";
        $this->Msg   = "學生班級歷程檔";
    }

    //取學生資料
    public static function Student($aParam = array())
    {
        $sACADYear  = $aParam['ACADYear'];
        $sSemester  = $aParam['Semester'];
        $sStudentID = $aParam['StudentID'];

        $sWhere = ' a.Year = ? AND a.Semester = ? AND a.StudentID = ? ';

        $aParam = array($sACADYear, $sSemester, $sStudentID);

        $aField = array_keys(
            array(
                "a.Year"                => "學年",
                "a.Semester"            => "學期",
                "b.DayfgName"           => "部別",
                "c.ClassTypeName"       => "學制",
                "e.UnitName AS College" => "學院",
                "d.UnitName"            => "系所",
                "f.StudyGroupName"      => "組別",
                "a.Grade"               => "年級",
                "g.ClassName"           => "班級",
                "h.StudentNo"           => "學號",
                "h.ChtName"             => "姓名",

            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = "tStuStdClassHist";

        $sSql = "
        SELECT DISTINCT {$sSelect}
                   FROM {$sTable} a
             INNER JOIN tDayfg b ON a.DayfgID = b.DayfgID
			 INNER JOIN tClassType c ON a.ClassTypeID = c.ClassTypeID
			 INNER JOIN tUnit d ON a.UnitID = d.UnitID
			 INNER JOIN tUnit e ON d.upper = e.UnitID
			  LEFT JOIN tStudyGroup f ON a.StudyGroupID = f.StudyGroupID
			 INNER JOIN tClass g ON a.ClassID = g.ClassID
			 INNER JOIN tStudent h ON a.StudentID = h.StudentID
                  WHERE {$sWhere}";
        // dd($sSql, $aParam);
        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //從指定年度與學期之後的資料(含當學年學期)，刪除學生班級歷程資料
    public function deleteStudentHist($sYear, $sSemester, $sStudentID)
    {
        $result = tStuStdClassHist::where(function ($query) use ($sYear, $sStudentID) {
            $query->where('Year', '>', $sYear)
                  ->where('StudentID', $sStudentID);
        })->orWhere(function ($query) use ($sYear, $sSemester, $sStudentID) {
            $query->where('Year', '=', $sYear)
                  ->where('Semester', '>=', $sSemester)
                  ->where('StudentID', '=', $sStudentID);
        })->delete();
        return $result;
    }
}
