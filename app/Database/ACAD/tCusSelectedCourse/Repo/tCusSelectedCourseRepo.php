<?php

namespace App\Database\ACAD\tCusSelectedCourse\Repo;

use Illuminate\Support\Facades\DB;

class tCusSelectedCourseRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tCusSelectedCourse";
        $this->Msg   = "";
    }

    //學年期成績
    public static function tCusSelectedCourseSetting($aParam = array())
    {
        // $sACADYear_srh = isset($aParam['sACADYear_srh']) ? $aParam['sACADYear_srh'] : null;
        // $sSemester_srh = isset($aParam['sSemester_srh']) ? $aParam['sSemester_srh'] : null;
        $sStudentID = $aParam['sStudentID'];

        $aParam = array();

        $sWhere = " AND a.StudentID = ? ";

        $aParam[] = $sStudentID;

        // if ($sACADYear_srh) {
        //     $sWhere .= " AND b.ACADYear = ? ";
        //     $aParam[] = $sACADYear_srh;
        // }
        // if ($sSemester_srh) {
        //     $sWhere .= " AND b.Semester = ? ";
        //     $aParam[] = $sSemester_srh;
        // }

        $aField = array_keys(
            array(
                "b.ACADYear"                                                   => "學年",
                "b.Semester"                                                   => "學期",
                "SUM(b.Credit) AS Credit"                                      => "學期學分數",
                "(SUM(convert(numeric,a.Score)))/count(a.Score) as TurthScore" => "學期平均分數",
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = 'tCusSelectedCourse';

        $sSql = "
        SELECT {$sSelect}
        FROM {$sTable} a
        join tCusSemesterCourse b on a.SemesterCourseID=b.SemesterCourseID
        join tCusCourseClass c on b.CourseClassID=c.CourseClassID
        join tCusCourse d on b.CourseID=d.CourseID
        WHERE a.IsLock=1 and b.IsStop=0 and a.State=1 and b.IsStop='0' {$sWhere}
        GROUP BY b.ACADYear,b.Semester
        ORDER BY b.ACADYear,b.Semester";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //實得總學分
    public static function ALLCredit($aParam = array())
    {
        $sACADYear_srh = isset($aParam['sACADYear']) ? $aParam['sACADYear'] : null;
        $sSemester_srh = isset($aParam['sSemester']) ? $aParam['sSemester'] : null;

        $sStudentID = $aParam['sStudentID'];

        $aParam = array();

        $sWhere = " AND a.StudentID = ? ";

        $aParam[] = $sStudentID;

        if ($sACADYear_srh) {
            $sWhere .= " AND b.ACADYear = ? ";
            $aParam[] = $sACADYear_srh;
        }
        if ($sSemester_srh) {
            $sWhere .= " AND b.Semester = ? ";
            $aParam[] = $sSemester_srh;
        }

        $aField = array_keys(
            array(
                "SUM(b.Credit) AS Credit"                                      => "學期學分數",
                "(SUM(convert(numeric,a.Score)))/count(a.Score) as TurthScore" => "學期平均分數",
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = 'tCusSelectedCourse';

        $sSql = "
        SELECT {$sSelect}
        FROM {$sTable} a
        join tCusSemesterCourse b on a.SemesterCourseID=b.SemesterCourseID
        join tCusCourseClass c on b.CourseClassID=c.CourseClassID
        join tCusCourse d on b.CourseID=d.CourseID
        WHERE a.IsLock=1 and b.IsStop=0 and a.State=1 and b.IsStop='0' {$sWhere}";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //學年期成績明細
    public static function tCusSelectedCourseDetail($aParam = array())
    {
        $sACADYear  = $aParam['sACADYear'];
        $sSemester  = $aParam['sSemester'];
        $sStudentID = $aParam['sStudentID'];

        $sWhere = ' a.StudentID = ? AND b.ACADYear = ? AND b.Semester = ?';

        $aParam = array($sStudentID, $sACADYear, $sSemester);

        $aField = array_keys(
            array(
                "c.CourseClassName"                                                     => "課程類別",
                "CASE WHEN c.Choose = '1' THEN '必修' ELSE '選修' END AS Choose"    => "修課類別",
                "'['+b.SemesterCourseNo+']'+b.SemesterCourseName as SemesterCourseName" => "課程名稱",
                // "Case
                //   when b.IsLockScore=0 or b.IsLockScore is null then '教師未鎖定'
                //   when d.IsTranscriptShowTureAndFalse=1 and Convert(int,IsNull(a.Score,0))>=@PassScore then 'T'
                //   when d.IsTranscriptShowTureAndFalse=1 and Convert(int,IsNull(a.Score,0))<@PassScore then 'F'
                //   else Convert(varchar,a.Score)
                //   end as Score"      => "成績是否鎖定",
                "(
                  Select Teacher+','
                    From tCusSemCourseTeacher
                   where SemesterCourseID=b.SemesterCourseID
                   Order by IsLeader desc
                   For XML path('')
                ) as Teacher"                                           => "授課老師",
                "b.Credit"                                                              => "學分",
                //"b.IsLockScore as LockState"     => "是否獎過相抵",
                "a.Score as TurthScore"                                                 => "分數",
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = 'tCusSelectedCourse';

        $sSql = "
        SELECT {$sSelect}
        FROM {$sTable} a
        join tCusSemesterCourse b on a.SemesterCourseID=b.SemesterCourseID
        join tCusCourseClass c on b.CourseClassID=c.CourseClassID
        join tCusCourse d on b.CourseID=d.CourseID
        WHERE {$sWhere}";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }
}
