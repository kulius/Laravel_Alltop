<?php

namespace App\Database\ACAD\tELCStdAttendance\Repo;

use App\Alltop\BaseModel;
use Illuminate\Support\Facades\DB;

class tELCStdAttendanceRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tELCStdAttendance";
        $this->Msg   = "語言班學生上課時數";
    }

    //取得學生上課時數資料
    public function getELCStdAttendance($aParams = array())
    {
        $aField = array_keys(array(
            "a.StudentID"                                     => "學生ID",
            "a.ClassCourseID"                                 => "課程ID",
            "b.StudentNo"                                     => "學號",
            "b.ChtName"                                       => "中文姓名",
            "b.FirstName"                                     => "firstname",
            "b.MiddleName"                                    => "middlename",
            "b.LastName"                                      => "lastname",
            "SUM(c.AttendanceHours) as AttendanceHours"       => "出席時數",
            "SUM(c.LateHours) as LateHours"                   => "遲到時數",
            "SUM(c.Illness) as Illness"                       => "病假時數",
            "SUM(c.PersonalleaveHours) as PersonalleaveHours" => "事假時數",
            "SUM(c.CutclassHours) as CutclassHours"           => "缺課時數",
        ));
        //條件
        $aWhere = BaseModel::setWhere($aParams);
        // dd($aParams, $aWhere);

        $sWhere = $aWhere["where"];
        $aParam = $aWhere["param"];

        $sSelect = implode(", ", $aField);
        $sTable  = 'tELCStdAttendance';

        $sSql = "
            SELECT {$sSelect}
              FROM tELCClassStdScore a
         LEFT JOIN tELCStudent b ON a.StudentID = b.StudentID
         LEFT JOIN tELCStdAttendance c ON a.StudentID = c.StudentID and a.ClassCourseID = c.ClassCourseID
             WHERE {$sWhere}
          GROUP BY a.StudentID, a.ClassCourseID, b.StudentNo, b.ChtName, b.FirstName, b.MiddleName, b.LastName
          ";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //取得學生上課時數的學生資料
    public function getELCStdAttendanceStu($aParams = array())
    {
        $aField = array_keys(array(
            "a.StudentID"       => "學生ID",
            "a.ClassCourseID"   => "課程ID",
            "a.TWYear"          => "年度",
            "a.Season"          => "季別",
            "c.ClassName"       => "班級名稱",
            "d.ClassCourseName" => "課程名稱",
            "b.StudentNo"       => "學號",
            "b.ChtName"         => "中文姓名",
            "b.FirstName"       => "firstname",
            "b.MiddleName"      => "middlename",
            "b.LastName"        => "lastname",
        ));
        //條件
        $aWhere = BaseModel::setWhere($aParams);
        // dd($aParams, $aWhere);

        $sWhere = $aWhere["where"];
        $aParam = $aWhere["param"];

        $sSelect = implode(", ", $aField);

        $sSql = "
            SELECT {$sSelect}
              FROM tELCClassStdScore a
         LEFT JOIN tELCStudent b ON a.StudentID = b.StudentID
         LEFT JOIN tELCClass c ON a.ClassID = c.ClassID
         LEFT JOIN tELCClassCourse d ON a.ClassCourseID = d.ClassCourseID
             WHERE {$sWhere}
          ";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //取得學生上課時數詳細資料
    public function getELCStdAttendanceDetail($aParams = array())
    {
        $aField = array_keys(array(
            "ClassCourseID"  => "課程",
            "StudentID"      => "學生",
            "SCDate"         => "日期",
            "AttendanceName" => "課程ID",
            "Hours"          => "年度",
            "AttendanceType" => "類型",

        ));

        $sStudentID     = isset($aParams["StudentID"]) ? $aParams["StudentID"] : null;
        $sClassCourseID = isset($aParams["ClassCourseID"]) ? $aParams["ClassCourseID"] : null;

        //條件
        $aParam = array($sStudentID, $sClassCourseID);
        // $aWhere = BaseModel::setWhere($aParams);
        // dd($aParams, $aWhere);
        // $sWhere = $aWhere["where"];
        // $aParam = $aWhere["param"];

        $sSelect = implode(", ", $aField);

        $sSql = "
            DECLARE @StudentID nvarchar(50) = ?
            DECLARE @ClassCourseID nvarchar(50) = ?

            SELECT {$sSelect} FROM (
            SELECT SCDate, '出席' as AttendanceName, AttendanceHours as Hours
                , ClassCourseID, StudentID, 'AttendanceHours' as AttendanceType
            FROM tELCStdAttendance
            WHERE StudentID = @StudentID and ClassCourseID = @ClassCourseID and AttendanceHours > 0
            UNION
            SELECT SCDate, '遲到' as AttendanceName, LateHours as Hours
                   , ClassCourseID, StudentID, 'LateHours' as AttendanceType
            FROM tELCStdAttendance
            WHERE StudentID = @StudentID and ClassCourseID = @ClassCourseID and LateHours > 0
            UNION
            SELECT SCDate, '缺席' as AttendanceName, CutclassHours as Hours
                , ClassCourseID, StudentID, 'CutclassHours' as AttendanceType
            FROM tELCStdAttendance
            WHERE StudentID = @StudentID and ClassCourseID = @ClassCourseID and CutclassHours > 0
            UNION
            SELECT SCDate, '事假' as AttendanceName, PersonalleaveHours as Hours
                , ClassCourseID, StudentID, 'PersonalleaveHours' as AttendanceType
            FROM tELCStdAttendance
            WHERE StudentID = @StudentID and ClassCourseID = @ClassCourseID and PersonalleaveHours > 0
            UNION
            SELECT SCDate, '病假' as AttendanceName, Illness as Hours
                , ClassCourseID, StudentID, 'Illness' as AttendanceType
            FROM tELCStdAttendance
            WHERE StudentID = @StudentID and ClassCourseID = @ClassCourseID and Illness > 0
            ) as a
            ORDER BY a.SCDate
          ";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //取得學生上課時數單筆編輯
    public function getELCStdAttendanceEdit($aParams = array())
    {
        $sStudentID      = isset($aParams["StudentID"]) ? $aParams["StudentID"] : null;
        $sClassCourseID  = isset($aParams["ClassCourseID"]) ? $aParams["ClassCourseID"] : null;
        $sSCDate         = isset($aParams["SCDate"]) ? $aParams["SCDate"] : null;
        $sAttendanceType = isset($aParams["AttendanceType"]) ? $aParams["AttendanceType"] : null;

        $aField = array_keys(array(
            "ClassCourseID"               => "課程",
            "StudentID"                   => "學生",
            "SCDate"                      => "日期",
            "{$sAttendanceType} AS Hours" => "出席類型",

        ));

        //條件
        $aParam = array($sStudentID, $sClassCourseID, $sSCDate);

        $sSelect = implode(", ", $aField);

        $sSql = "
            SELECT {$sSelect}
              FROM tELCStdAttendance
             WHERE StudentID = ? and ClassCourseID = ? and SCDate = ?
          ";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }
}
