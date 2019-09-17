<?php

namespace App\Database\ACAD\tBhrRptSemStuBhrSpread\Repo;

use Illuminate\Support\Facades\DB;

class tBhrRptSemStuBhrSpreadRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tBhrRptSemStuBhrSpread";
        $this->Msg   = "學生操行統計表";
    }

    //查詢主頁資料 (管理員/學生/老師)
    public static function tBhrRptSemStuBhrSpreadSetting($aParam = array())
    {
        $sACADYear_srh   = isset($aParam['sACADYear_srh']) ? $aParam['sACADYear_srh'] : null;
        $sSemester_srh   = isset($aParam['sSemester_srh']) ? $aParam['sSemester_srh'] : null;
        $sDayfg_srh      = isset($aParam['sDayfg_srh']) ? $aParam['sDayfg_srh'] : null;
        $sClassType_srh  = isset($aParam['sClassType_srh']) ? $aParam['sClassType_srh'] : null;
        $sCollege_srh    = isset($aParam['sCollege_srh']) ? $aParam['sCollege_srh'] : null;
        $sUnit_srh       = isset($aParam['sUnit_srh']) ? $aParam['sUnit_srh'] : null;
        $sStudyGroup_srh = isset($aParam['sStudyGroup_srh']) ? $aParam['sStudyGroup_srh'] : null;
        $sGrade_srh      = isset($aParam['sGrade_srh']) ? $aParam['sGrade_srh'] : null;
        $sClass_srh      = isset($aParam['sClass_srh']) ? $aParam['sClass_srh'] : null;
        $sNoOrName_srh   = isset($aParam['sNoOrName_srh']) ? $aParam['sNoOrName_srh'] : null;

        //學生登入時帶入學生學號
        $sStudentNo = isset($aParam['sStudentNo']) ? $aParam['sStudentNo'] : null;

        //老師登入時帶入老師帳號
        $sTeacherNo = isset($aParam['sTeacherNo']) ? $aParam['sTeacherNo'] : null;
        // dd($aParam['sCollege_srh']);

        $sWhere = " 1 = 1 ";

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
        if ($sCollege_srh) {
            if ($sTeacherNo) {
                $sWhere .= " AND b.CollegeID = ? ";
            } else {
                $sWhere .= " AND a.CollegeID = ? ";
            }
            $aParam[] = $sCollege_srh;
        }
        if ($sUnit_srh) {
            $sWhere .= " AND a.UnitID = ? ";
            $aParam[] = $sUnit_srh;
        }
        if ($sStudyGroup_srh) {
            $sWhere .= " AND a.StudyGroupID = ? ";
            $aParam[] = $sStudyGroup_srh;
        }
        if ($sGrade_srh) {
            $sWhere .= " AND a.Grade = ? ";
            $aParam[] = $sGrade_srh;
        }
        if ($sClass_srh) {
            if ($sTeacherNo) {
                $sWhere .= " AND a.ClassID = ? ";
            } else {
                $sWhere .= " AND a.ClassNo = ? ";
            }

            $aParam[] = $sClass_srh;
        }
        if ($sNoOrName_srh) {
            if ($sTeacherNo) {
                $sWhere .= " AND b.StudentNo Like '%$sNoOrName_srh%' OR b.ChtName LIKE '%$sNoOrName_srh%' ";
            } else {
                $sWhere .= " AND a.StudentNo Like '%$sNoOrName_srh%' OR a.ChtName LIKE '%$sNoOrName_srh%' ";
            }
        }

        //學生登入時帶入學生學號
        if ($sStudentNo) {
            $sWhere .= " AND a.StudentNo = ?";
            $aParam[] = $sStudentNo;
        }
        //老師登入時帶入老師帳號
        if ($sTeacherNo) {
            $sWhere .= " AND a.TeacherID = ?";
            $aParam[] = $sTeacherNo;
        }

        if ($sTeacherNo) {
            $aField = array_keys(
                array(
                    "b.tBhrRptSemStuBhrSpreadID"                                                      => "學生操行統計表ID",
                    "c.ClassName"                                                                     => "班級",
                    "b.StudentNo"                                                                     => "學號",
                    "b.ChtName"                                                                       => "姓名",
                    "b.BehaviorScore"                                                                 => "操行總分",
                    "b.BehBasisScore"                                                                 => "操行基本分",
                    "b.SetScore"                                                                      => "直接設定分數",
                    "CASE WHEN b.SetScore = '0' THEN b.BehaviorScore ELSE b.SetScore END AS EndScore" => "最終成績",
                    "b.RP4"                                                                           => "嘉獎",
                    "b.RP5"                                                                           => "小功",
                    "b.RP6"                                                                           => "大功",
                    "b.RP1"                                                                           => "已註銷申誡",
                    "b.RP2"                                                                           => "已註銷小過",
                    "b.RP3"                                                                           => "已註銷大過",
                    "b.AbsentRoll1"                                                                   => "公假",
                    "b.AbsentRoll2"                                                                   => "事假",
                    "b.AbsentRoll3"                                                                   => "病假",
                    "b.AbsentRoll5"                                                                   => "喪假",
                    "b.AbsentRoll9"                                                                   => "分娩",
                    "b.AbsentRoll10"                                                                  => "生理假",
                    "b.AbsentRoll11"                                                                  => "缺曠課",
                )
            );

            $sSelect = implode(", ", $aField);
            $sTable  = 'tBhrTutor';

            $sSql = "
            SELECT {$sSelect}
            FROM {$sTable} a
                LEFT JOIN tBhrRptSemStuBhrSpread b
                    ON a.ACADYear = b.ACADYear
                    AND a.Semester = b.Semester
                    AND a.DayfgID = b.DayfgID
                    AND a.ClassTypeID = b.ClassTypeID
                    AND a.UnitID = b.UnitID
                    AND a.ClassID = b.ClassID
                LEFT JOIN tClass c ON b.ClassID = c.ClassID
            WHERE {$sWhere}
            ORDER BY a.ACADYear, a.Semester";
        } else {
            $aField = array_keys(
                array(
                    "a.tBhrRptSemStuBhrSpreadID"                                                      => "學生操行統計表ID",
                    "b.ClassName"                                                                     => "班級",
                    "a.StudentNo"                                                                     => "學號",
                    "a.ChtName"                                                                       => "姓名",
                    "a.BehaviorScore"                                                                 => "操行總分",
                    "a.BehBasisScore"                                                                 => "操行基本分",
                    "a.SetScore"                                                                      => "直接設定分數",
                    "CASE WHEN a.SetScore = '0' THEN a.BehaviorScore ELSE a.SetScore END AS EndScore" => "最終成績",
                    "a.RP4"                                                                           => "嘉獎",
                    "a.RP5"                                                                           => "小功",
                    "a.RP6"                                                                           => "大功",
                    "a.RP1"                                                                           => "已註銷申誡",
                    "a.RP2"                                                                           => "已註銷小過",
                    "a.RP3"                                                                           => "已註銷大過",
                    "a.AbsentRoll1"                                                                   => "公假",
                    "a.AbsentRoll2"                                                                   => "事假",
                    "a.AbsentRoll3"                                                                   => "病假",
                    "a.AbsentRoll5"                                                                   => "喪假",
                    "a.AbsentRoll9"                                                                   => "分娩",
                    "a.AbsentRoll10"                                                                  => "生理假",
                    "a.AbsentRoll11"                                                                  => "缺曠課",
                )
            );

            $sSelect = implode(", ", $aField);
            $sTable  = 'tBhrRptSemStuBhrSpread';

            $sSql = "
            SELECT {$sSelect}
            FROM {$sTable} a
                LEFT JOIN tClass b ON a.ClassID = b.ClassID
            WHERE {$sWhere}
            ORDER BY a.ACADYear, a.Semester";
        }

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //編輯或檢視
    public static function viewSetting($id = null)
    {
        $tBhrRptSemStuBhrSpreadID = isset($id) ? $id : null;

        $sWhere = " 1 = 1 ";

        $aParam = array();

        if ($tBhrRptSemStuBhrSpreadID) {
            $sWhere .= "AND tBhrRptSemStuBhrSpreadID = ? ";
            $aParam[] = $tBhrRptSemStuBhrSpreadID;
        }

        $aField = array_keys(
            array(
                "a.tBhrRptSemStuBhrSpreadID"                                                      => "學生操行統計表ID",
                "a.ACADYear"                                                                      => "學年",
                "a.Semester"                                                                      => "學期",
                "a.DayfgID"                                                                       => "部別ID",
                "b.DayfgName"                                                                     => "部別",
                "a.ClassTypeID"                                                                   => "學制ID",
                "c.ClassTypeName"                                                                 => "學制",
                "a.CollegeID"                                                                     => "學院ID",
                "d.UnitName"                                                                      => "學院",
                "a.UnitID"                                                                        => "系所ID",
                "e.UnitName"                                                                      => "系所",
                "a.StudyGroupID"                                                                  => "組別ID",
                "f.StudyGroupName"                                                                => "組別",
                "a.ClassID"                                                                       => "班級ID",
                "g.ClassName"                                                                     => "班級",
                "a.StudentNo"                                                                     => "學號",
                "a.ChtName"                                                                       => "姓名",
                "a.BehaviorScore"                                                                 => "操行總分",
                "a.BehBasisScore"                                                                 => "操行基本分",
                "a.SetScore"                                                                      => "直接設定分數",
                "CASE WHEN a.SetScore = '0' THEN a.BehaviorScore ELSE a.SetScore END AS EndScore" => "最終成績",
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = 'tBhrRptSemStuBhrSpread';

        $sSql = "
        SELECT {$sSelect}
        FROM {$sTable} a
            LEFT JOIN tDayfg b ON a.DayfgID = b.DayfgID
            LEFT JOIN tClassType c ON a.ClassTypeID = c.ClassTypeID
            LEFT JOIN tUnit d ON a.CollegeID = d.UnitID
            LEFT JOIN tUnit e ON a.UnitID = e.UnitID
            LEFT JOIN tStudyGroup f ON a.StudyGroupID = f.StudyGroupID
            LEFT JOIN tClass g ON a.ClassID = g.ClassID
        WHERE {$sWhere}
        ORDER BY a.ACADYear, a.Semester";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //老師登入時用的查詢下拉
    public function Teacher_combo($sel, $sTeacherNo, $aParams = array())
    {
        $sACADYear     = isset($aParams["ACADYear"]) ? $aParams["ACADYear"] : null;
        $sSemester     = isset($aParams["Semester"]) ? $aParams["Semester"] : null;
        $sDayfgID      = isset($aParams["DayfgID"]) ? $aParams["DayfgID"] : null;
        $sClassTypeID  = isset($aParams["ClassTypeID"]) ? $aParams["ClassTypeID"] : null;
        $sUnitID       = isset($aParams["UnitID "]) ? $aParams["UnitID "] : null;
        $sStudyGroupID = isset($aParams["StudyGroupID "]) ? $aParams["StudyGroupID "] : null;
        $sGrade        = isset($aParams["Grade "]) ? $aParams["Grade "] : null;

        //條件
        $sTable = 'tBhrTutor';

        $aParam = array();

        $sWhere = " TeacherID = ? ";

        $aParam[] = $sTeacherNo;

        if ($sACADYear) {
            $sWhere .= " AND a.ACADYear = ? ";
            $aParam[] = $sACADYear;
        }
        if ($sSemester) {
            $sWhere .= " AND a.Semester = ? ";
            $aParam[] = $sSemester;
        }
        if ($sDayfgID) {
            $sWhere .= " AND a.DayfgID = ? ";
            $aParam[] = $sDayfgID;
        }
        if ($sClassTypeID) {
            $sWhere .= " AND a.ClassTypeID = ? ";
            $aParam[] = $sClassTypeID;
        }
        if ($sUnitID) {
            $sWhere .= " AND a.UnitID = ? ";
            $aParam[] = $sUnitID;
        }
        if ($sStudyGroupID) {
            $sWhere .= " AND a.StudyGroupID = ? ";
            $aParam[] = $sStudyGroupID;
        }
        if ($sGrade) {
            $sWhere .= " AND a.Grade = ? ";
            $aParam[] = $sGrade;
        }

        switch ($sel) {
            //部別
            case 'Dayfg':
                $aField = array_keys(array(
                    "b.DayfgID AS [value]"  => "部別ID",
                    "b.DayfgName AS [text]" => "部別名稱",
                ));

                $sSelect = implode(", ", $aField);

                $sSql = "
                SELECT {$sSelect}
                FROM {$sTable} a
                    LEFT JOIN tDayfg b ON a.DayfgID = b.DayfgID
                WHERE {$sWhere}
                GROUP BY b.DayfgID,b.DayfgName";
                break;
            //學制
            case 'ClassType':
                $aField = array_keys(array(
                    "b.ClassTypeID AS [value]"  => "學制ID",
                    "b.ClassTypeName AS [text]" => "學制名稱",
                ));

                $sSelect = implode(", ", $aField);

                $sSql = "
                SELECT {$sSelect}
                FROM {$sTable} a
                    LEFT JOIN tClassType b ON a.ClassTypeID = b.ClassTypeID
                WHERE {$sWhere}
                GROUP BY b.ClassTypeID,b.ClassTypeName";
                break;
            //學院
            case 'College':
                $aField = array_keys(array(
                    "C.UnitID AS [value]"  => "學院ID",
                    "C.UnitName AS [text]" => "學院名稱",
                ));

                $sSelect = implode(", ", $aField);

                $sSql = "
                SELECT {$sSelect}
                FROM {$sTable} a
                    LEFT JOIN tUnit b ON a.UnitID = b.UnitID
                    LEFT JOIN tUnit c ON b.upper =c.UnitID
                WHERE {$sWhere}
                GROUP BY c.UnitID,c.UnitName";
                break;
            //系所
            case 'Unit':
                $aField = array_keys(array(
                    "b.UnitID AS [value]"  => "系所ID",
                    "b.UnitName AS [text]" => "系所名稱",
                ));

                $sSelect = implode(", ", $aField);

                $sSql = "
                SELECT {$sSelect}
                FROM {$sTable} a
                    LEFT JOIN tUnit b ON a.UnitID = b.UnitID
                WHERE {$sWhere}
                GROUP BY b.UnitID,b.UnitName";
                break;
            //組別
            case 'StudyGroup':
                $aField = array_keys(array(
                    "b.StudyGroupID AS [value]"  => "系所ID",
                    "b.StudyGroupName AS [text]" => "系所名稱",
                ));

                $sSelect = implode(", ", $aField);

                $sSql = "
                SELECT {$sSelect}
                FROM {$sTable} a
                    LEFT JOIN tStudyGroup b ON a.StudyGroupID = b.StudyGroupID
                WHERE {$sWhere}
                GROUP BY b.StudyGroupID,b.StudyGroupName";
                break;
            //年級
            case 'Grade':
                $aField = array_keys(array(
                    "a.Grade AS [value]" => "年級",
                    "a.Grade AS [text]"  => "年級",
                ));

                $sSelect = implode(", ", $aField);

                $sSql = "
                SELECT {$sSelect}
                FROM {$sTable} a
                WHERE {$sWhere}
                GROUP BY a.Grade";
                break;
            //班級
            case 'Class':
                $aField = array_keys(array(
                    "b.ClassID AS [value]"  => "班級ID",
                    "b.ClassName AS [text]" => "班級名稱",
                ));

                $sSelect = implode(", ", $aField);

                $sSql = "
                    SELECT {$sSelect}
                    FROM {$sTable} a
                    LEFT JOIN tClassAll b ON a.ClassID = b.ClassID
                    WHERE {$sWhere}
                    GROUP BY b.ClassID, b.ClassName";
                break;

            default:
                break;
        }

        return DB::connection('ACAD')->select($sSql, $aParam);
    }
}
