<?php

namespace App\Database\ACAD\tBhrRptAbsentList\Repo;

use Illuminate\Support\Facades\DB;

class tBhrRptAbsentListRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tBhrRptAbsentList";
        $this->Msg   = "缺曠請假展開表";
    }

    //取得登錄者資訊(寫在RptAbsentListSetting裡會出錯)
    public static function user($aParam = array())
    {

        $sStudentID = isset($aParam['sStudentID']) ? $aParam['sStudentID'] : null;

        $sWhere = " StudentID = '$sStudentID' ";

        $aParam = array();

        $aField = array_keys(
            array(
                "b.DayfgName" => "部別",
                "c.ClassName" => "班級",
                'a.StudentNo' => '學號',
                'a.ChtName'   => '姓名',
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = 'tBhrRptAbsentList';

        $sSql = "
        SELECT {$sSelect}
        FROM {$sTable} a
            LEFT JOIN tDayfg b ON a.DayfgID = b.DayfgID
            LEFT JOIN tClass c ON a.ClassID = c.ClassID
        WHERE {$sWhere}
        GROUP BY b.DayfgName, c.ClassName, a.StudentNo, a.ChtName";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    public static function RptAbsentListSetting($aParam = array())
    {

        $sStudentID          = isset($aParam['sStudentID']) ? $aParam['sStudentID'] : null;
        $sACADYear_srh       = isset($aParam['sACADYear_srh']) ? $aParam['sACADYear_srh'] : null;
        $sSemester_srh       = isset($aParam['sSemester_srh']) ? $aParam['sSemester_srh'] : null;
        $sSemesterCourse_srh = isset($aParam['sCourse_srh']) ? $aParam['sCourse_srh'] : null;
        $sstatus_srh         = isset($aParam['sstatus_srh']) ? $aParam['sstatus_srh'] : null;

        $sWhere = " StudentID = '$sStudentID' ";

        $aParam = array();

        if ($sACADYear_srh) {
            $sWhere .= " AND a.ACADYear = ? ";
            $aParam[] = $sACADYear_srh;
        }
        if ($sSemester_srh) {
            $sWhere .= " AND a.Semester = ? ";
            $aParam[] = $sSemester_srh;
        }
        if ($sSemesterCourse_srh) {
            $sWhere .= " AND a.SemesterCourseID = ? ";
            $aParam[] = $sSemesterCourse_srh;
        }
        if ($sstatus_srh != null) {
            $sWhere .= " AND a.status = ? ";
            $aParam[] = $sstatus_srh;
        }

        $aField = array_keys(
            array(
                "a.RptAbsentList"                                                               => "缺曠請假展開表ID",
                "a.ACADYear"                                                                    => "學年",
                "a.Semester"                                                                    => "學期",
                "b.DayfgName"                                                                   => "部別",
                "c.ClassName"                                                                   => "班級",
                "d.SemesterCourseName"                                                          => "課程名稱",
                'a.StudentNo'                                                                   => '學號',
                'a.ChtName'                                                                     => '姓名',
                'e.LeaveKindName'                                                               => '請假類別',
                "CONVERT(varchar(12) , a.RollCallDate, 111 )
                    +'('+DATENAME(Weekday, a.RollCallDate)+')' AS RollCallDate" => '請假日期',
                'a.DayKind'                                                                     => '星期',
                'a.week'                                                                        => '週次',
                'a.SectionSeq'                                                                  => '節次',
                'a.LeaveReason'                                                                 => '假由',
                "CASE WHEN a.status ='0' THEN '未送出'
                      WHEN a.status ='1' THEN '流程中'
                      WHEN a.status ='2' THEN '退回'
                      WHEN a.status ='3' THEN '不通過'
                      ELSE '已通過' END AS status "                          => '審核狀態',
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = 'tBhrRptAbsentList';

        $sSql = "
        SELECT {$sSelect}
        FROM {$sTable} a
            LEFT JOIN tDayfg b ON a.DayfgID = b.DayfgID
			LEFT JOIN tClass c ON a.ClassID = c.ClassID
			LEFT JOIN tCusSemesterCourse d ON a.SemesterCourseID = d.SemesterCourseID
			LEFT JOIN tBhrLeaveKind e ON a.LeaveKindID = e.LeaveKindID
        WHERE {$sWhere}
        ORDER BY a.ACADYear, a.Semester";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //取得登錄者資訊 (老師)
    public static function teacher($aParam = array())
    {
        $sPNO = isset($aParam['sPNO']) ? $aParam['sPNO'] : null;

        $sWhere = " PNO = '$sPNO' ";

        $aParam = array();

        $aField = array_keys(
            array(
                "Teacher" => "老師",
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = 'tCusSemCourseTeacher';

        $sSql = "
        SELECT {$sSelect}
        FROM {$sTable}
        WHERE {$sWhere}
        GROUP BY Teacher";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    public static function TeacherSrhSetting($aParam = array())
    {
        $sDEPNO              = isset($aParam['sPNO']) ? $aParam['sPNO'] : null;
        $sACADYear_srh       = isset($aParam['sACADYear_srh']) ? $aParam['sACADYear_srh'] : null;
        $sSemester_srh       = isset($aParam['sSemester_srh']) ? $aParam['sSemester_srh'] : null;
        $sSemesterCourse_srh = isset($aParam['sCourse_srh']) ? $aParam['sCourse_srh'] : null;
        $sNoOrName_srh       = isset($aParam['sNoOrName_srh']) ? $aParam['sNoOrName_srh'] : null;
        $sstatus_srh         = isset($aParam['sstatus_srh']) ? $aParam['sstatus_srh'] : null;

        $sWhere = " a.DEPNO = '$sDEPNO' ";

        $aParam = array();

        if ($sACADYear_srh) {
            $sWhere .= " AND a.ACADYear = ? ";
            $aParam[] = $sACADYear_srh;
        }
        if ($sSemester_srh) {
            $sWhere .= " AND a.Semester = ? ";
            $aParam[] = $sSemester_srh;
        }
        if ($sSemesterCourse_srh) {
            $sWhere .= " AND a.SemesterCourseID = ? ";
            $aParam[] = $sSemesterCourse_srh;
        }
        if ($sstatus_srh != null) {
            $sWhere .= " AND b.status = ? ";
            $aParam[] = $sstatus_srh;
        }
        //dd($aParam);
        if ($sNoOrName_srh) {
            $sWhere .= " AND (b.StudentNo Like '$sNoOrName_srh' OR b.ChtName Like '%$sNoOrName_srh%')  ";
        }

        $aField = array_keys(
            array(
                "b.RptAbsentList"                                                               => "缺曠請假展開表ID",
                "a.ACADYear"                                                                    => "學年",
                "a.Semester"                                                                    => "學期",
                "a.SemesterCourseName+'【'+a.StudyClassName+'】' AS SemesterCourseName"       => "課程名稱",
                'b.StudentNo'                                                                   => '學號',
                'b.ChtName'                                                                     => '姓名',
                'c.LeaveKindName'                                                               => '請假類別',
                "CONVERT(varchar(12) , b.RollCallDate, 111 )
                    +'('+DATENAME(Weekday, b.RollCallDate)+')' AS RollCallDate" => '請假日期',
                'b.week'                                                                        => '週次',
                'b.SectionSeq'                                                                  => '節次',
                'b.LeaveReason'                                                                 => '假由',
                "CASE WHEN b.status ='0' THEN '未送出'
                      WHEN b.status ='1' THEN '流程中'
                      WHEN b.status ='2' THEN '退回'
                      WHEN b.status ='3' THEN '不通過'
                      ELSE '已通過' END AS status "                          => '審核狀態',
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = 'tCusSemesterCourse';

        $sSql = "
        SELECT {$sSelect}
        FROM {$sTable} a
            LEFT JOIN tBhrRptAbsentList b ON a.SemesterCourseID = b.SemesterCourseID
            LEFT JOIN tBhrLeaveKind c ON b.LeaveKindID = c.LeaveKindID
        WHERE {$sWhere} AND b.StudentID is not NULL
        GROUP BY b.RptAbsentList, a.ACADYear, a.Semester, a.SemesterCourseName, a.StudyClassName
                ,b.StudentNo, b.ChtName, c.LeaveKindName, b.RollCallDate, b.RollCallDate, b.DayKind
                ,b.week, b.SectionSeq, b.LeaveReason, b.status
";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }
}
