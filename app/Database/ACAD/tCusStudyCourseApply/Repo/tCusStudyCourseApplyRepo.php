<?php

namespace App\Database\ACAD\tCusStudyCourseApply\Repo;

use App\Alltop\BaseModel;
use Illuminate\Support\Facades\DB;

class tCusStudyCourseApplyRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tCusStudyCourseApply";
        $this->Msg   = "課程結構與教學科目表適用學生";
    }

    public function getStudentWithClassType(array $aParams = null)
    {
        /** 常見條件
         *    a.Year = ? and a.Semester = ? and a.Grade = ? and a.ClassID = ?
         *  a.DayfgID = ? and a.ClassTypeID = ? and a.UnitID = ? and a.StudyGroupID = ?
         *  and c.ApproveStatus = '3'
         */
        $aCondition = BaseModel::setWhere($aParams);
        $sWhere     = $aCondition['where'];
        $aParam     = $aCondition['param'];
        $aField     = array_keys(array(
            'a.Year'             => '學年',
            'a.Semester'         => '學期',
            'a.DayfgID'          => '部別',
            'a.ClassTypeID'      => '學制',
            'a.UnitID'           => '系所',
            'b.StudentNo'        => '學號',
            'b.ChtName'          => '姓名',
            'c.ClassName'        => '班級名稱',
            'd.StudyCourseName'  => '課架名稱',
            'b.MailingPhone'     => '通訊電話',
            'b.MailingAddress'   => '通訊地址',
            'b.Email'            => '電子信箱',
            'd.ApproveStatus'    => '審核狀態', //TODO::通常是 3(審核通過) 待需討論，也只會有通過的狀態
            'd.UpdateID'         => '審核者',
            'd.StudyCourseApply' => 'PK',
            'a.StudyGroupID'     => '組別',
            'b.StudentID'        => '學生ID',
        ));

        $sColumn = implode(',', $aField);
        //TODO::
        /** 下面這段撈不到資料，導致沒辦法抓到已存在 tCusStudyCourseApply 的資料
         * select d2.StudyYear,d2.StudySemester
        ,d2.StudentID,d2.StudyCourseID,d1.StudyCourseName, d2.ApproveStatus, d2.UpdateID
        ,d2.StudyCourseApply
        from tCusStudyCourse d1
        join tCusStudyCourseApply d2
        on d1.StudyClassID=d2.StudyCourseID
        where d1.StudyKind='4'
         */
        $sSql = "select $sColumn
					  from tStuStdClassHist a
					  join vStuStudentAll b
						on a.studentid=b.studentid
					join tClassAll c
						on a.Year=c.ACADYear
						and a.Semester=c.Semester
						and a.ClassID=c.ClassID
					left join (
						select d2.StudyYear,d2.StudySemester
						,d2.StudentID,d2.StudyCourseID,d1.StudyCourseName, d2.ApproveStatus, d2.UpdateID
                        ,d2.StudyCourseApply
						from tCusStudyCourse d1
						join tCusStudyCourseApply d2
							on d1.StudyCourseID=d2.StudyCourseID
						where d1.StudyKind='4'
					) d
						on a.StudentID=d.StudentID
						and a.Year=d.StudyYear
						and a.Semester=d.StudySemester WHERE $sWhere";
        //dd($sSql, $aParam);
        return DB::connection('ACAD')->select($sSql, $aParam);
    }
}
