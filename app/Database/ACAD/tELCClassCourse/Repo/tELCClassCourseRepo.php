<?php

namespace App\Database\ACAD\tELCClassCourse\Repo;

use App\Alltop\BaseModel;
use Illuminate\Support\Facades\DB;

class tELCClassCourseRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tELCClassCourse";
        $this->Msg   = "語言班班級課程";
    }

    public function getClassCoruseAndTeacher(array $aParams = null)
    {
        $aColumn = array(
            'a.ClassCourseID'                                                  => '課程ID',
            'a.ClassCourseNo'                                                  => '課程代碼',
            'a.ClassCourseName'                                                => '課程名稱',
            'a.ClassCourseEngName'                                             => '課程英文名稱',
            "(STUFF(
                (SELECT ',' + b.TeacherName
                    FROM tELCClassCourseTeacher b
                    WHERE a.ClassCourseID = b.ClassCourseID
                    FOR XML PATH('')
                    )
                ,1,1,'')
            ) AS TeacherName"                                      => '子查詢撈出老師名字',
            "a.ClassRoomID"                                                    => '教室名稱',
            "STUFF((SELECT  ',' +  cast(Section AS NVARCHAR ) from(
                select DISTINCT
                Case aa.DayKind
                when '1' then '一'
                when '2' then '二'
                when '3' then '三'
                when '4' then '四'
                when '5' then '五'
                when '6' then '六'
                when '7' then '日'
                else '' end
                + '('+ STUFF((SELECT ','+CAST(a2.SectionName AS NVARCHAR)
                            FROM tELCClassCourseTeacherDate a1
                            LEFT JOIN tCusSection a2 on a1.SectionSeq = a2.SectionSeq
                            WHERE a1.ClassCourseID = aa.ClassCourseID AND a1.Emp_ID = aa.Emp_ID
                                  AND a1.Daykind = aa.DayKind
                                  Group By a2.SectionName, a2.Seq
                            ORDER BY a2.Seq
                            FOR XML PATH('')), 1, 1, '') + ')' as Section
                from tELCClassCourseTeacherDate aa
                where aa.ClassCourseID=a.ClassCourseID
                ) bb
                FOR XML PATH('')), 1, 1, '') as DayKindAndSection" => '上課時段',
            "a.ClassCourseHour"                                                => '課程總時數',
            "a.CourseDateFirst"                                                => '課程開始日期',
            "a.CourseDateLast"                                                 => '課程結束日期',
            "a.CourseMemo"                                                     => '課程備註',
            "",
        );
        //只取 key Sql 表達式部分
        $aColumn = array_keys($aColumn);

        $aCondition = BaseModel::setWhere($aParams);

        $sWhere  = $aCondition['where'];
        $aParam  = $aCondition['param'];
        $sColumn = implode(', ', $aColumn);
        $sSql    = "select $sColumn from  tELCClassCourse a
                    WHERE $sWhere";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    public function getClassCoruseAndTeacherDate(array $aParams = null)
    {
        $aColumn = array(
            "a.TeacherName + a.TeacherEngName as TeacherName"                  => '子查詢撈出老師名字',
            "STUFF((SELECT  ',' +  cast(Section AS NVARCHAR ) from(
                select DISTINCT
                Case aa.DayKind
                when '1' then '一'
                when '2' then '二'
                when '3' then '三'
                when '4' then '四'
                when '5' then '五'
                when '6' then '六'
                when '7' then '日'
                else '' end
                + '('+ STUFF((SELECT ','+CAST(a2.SectionName AS NVARCHAR)
                            FROM tELCClassCourseTeacherDate a1
                            LEFT JOIN tCusSection a2 on a1.SectionSeq = a2.SectionSeq
                            WHERE a1.ClassCourseID = aa.ClassCourseID AND a1.Emp_ID = aa.Emp_ID
                                  AND a1.Daykind = aa.DayKind
                            Group By a2.SectionName, a2.Seq
                            ORDER BY a2.Seq FOR XML PATH('')), 1, 1, '') + ')' as Section
                from tELCClassCourseTeacherDate aa
                where aa.ClassCourseID=a.ClassCourseID and a.Emp_ID = aa.Emp_ID
                ) bb
                FOR XML PATH('')), 1, 1, '') as DayKindAndSection" => '上課時段',
            "a.TeachHour"                                                      => '授課時數',
            "a.TeacherMemo"                                                    => '教師課程備註',
            'a.ClassCourseTeacherID'                                           => '主鍵',
        );
        //只取 key Sql 表達式部分
        $aColumn = array_keys($aColumn);

        $aCondition = BaseModel::setWhere($aParams);

        $sWhere  = $aCondition['where'];
        $aParam  = $aCondition['param'];
        $sColumn = implode(', ', $aColumn);
        $sSql    = "select $sColumn from  tELCClassCourseTeacher a
                    WHERE $sWhere";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }
}
