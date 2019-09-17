<?php

namespace App\Database\ACAD\tEnrAdmitAmount\Repo;

use App\Alltop\BaseModel;
use Illuminate\Support\Facades\DB;

class tEnrAdmitAmountRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tEnrAdmitAmount";
        $this->Msg   = "招生名額";
    }
    public function read(array $aParams = array())
    {
        $aField = array_keys(array(
            "a.AdmitAmountID"             => "招生核定名額代碼",
            "a.EnrollYear"                => "招生學年",
            "a.Semester"                  => "學期",
            "a.DayfgID"                   => "招生部別",
            "a.ClassTypeID"               => "招生學制",
            "a.UnitID"                    => "招生科系",
            "a.CollegeID"                 => "招生學院",
            "a.AdmitAmt"                  => "錄取人數",
            "a.AdmitClassAmt"             => "招生班數",
            "a.StudyGroupID"              => "組別ID",
            "a.EnrollTypeID"              => "入學管道ID",
            "a.UpdateDate"                => "異動時間",
            "a.UpdateID"                  => "異動人",
            "a.ApprovedAmt"               => "核定人數",
            "a.ExtraAmt"                  => "外加人數",
            "a.ExamAmt"                   => "報考人數",
            "b.AdvanceEntryAmt"           => "提前入學人數",
            "c.RegistrationAmt EnrollAmt" => "報到人數",
            "d.ReservationAmt"            => "保留人數",
            "c.RegistrationAmt"           => "註冊人數",
            "a.Memo"                      => "備取狀況",
            "a.FirstDate"                 => "限時開始日期",
            "a.LastDate"                  => "限時結束日期",
            "e.DayfgName"                 => "部別名稱",
            "f.ClassTypeName"             => "學制名稱",
            "g.UnitName"                  => "科系名稱",
            "h.UnitName AS CollegeName"   => "學院名稱",
            "i.StudyGroupName"            => "組別名稱",
            "j.EnrollTypeName"            => "入學管道名稱",
        ));

        //條件
        $aWhere = BaseModel::setWhere($aParams);

        $sWhere = $aWhere["where"];
        $aParam = $aWhere["param"];

        $sSelect = implode(", ", $aField);
        $sTable  = $this->Table;

        $sSql = "
                 select {$sSelect}
                from {$sTable} a
                left join (
                    select a.EnrollYear,a.EnrollSemester,a.EnrollTypeID
                    ,a.DayfgID,a.ClassTypeID,a.UnitID,a.StudyGroupID
                    ,COUNT(1) AdvanceEntryAmt
                    from tStuNewStudent a
                    join vStuStudentAll b
                        on a.NewStdID=b.NewStdID
                    join tStuStateChange c
                        on b.StudentID=c.StudentID
                    where c.ChangeKind='20'
                    group by a.EnrollYear,a.EnrollSemester,a.EnrollTypeID
                    ,a.DayfgID,a.ClassTypeID,a.UnitID,a.StudyGroupID
                ) b
                    on a.EnrollYear=b.EnrollYear
                    and a.Semester=b.EnrollSemester
                    and a.EnrollTypeID=b.EnrollTypeID
                    and a.DayfgID=b.DayfgID
                    and a.ClassTypeID=b.ClassTypeID
                    and a.UnitID=b.UnitID
                    and a.StudyGroupID=b.StudyGroupID
                left join (
                    select a.EnrollYear,a.EnrollSemester,a.EnrollTypeID
                    ,a.DayfgID,a.ClassTypeID,a.UnitID,a.StudyGroupID
                    ,COUNT(1) RegistrationAmt
                    from tStuNewStudent a
                    join vStuStudentAll b
                        on a.NewStdID=b.NewStdID
                    join tStuStateChange c
                        on b.StudentID=c.StudentID
                    group by a.EnrollYear,a.EnrollSemester,a.EnrollTypeID
                    ,a.DayfgID,a.ClassTypeID,a.UnitID,a.StudyGroupID
                ) c
                    on a.EnrollYear=c.EnrollYear
                    and a.Semester=c.EnrollSemester
                    and a.EnrollTypeID=c.EnrollTypeID
                    and a.DayfgID=c.DayfgID
                    and a.ClassTypeID=c.ClassTypeID
                    and a.UnitID=c.UnitID
                    and a.StudyGroupID=c.StudyGroupID
                left join (
                    select a.EnrollYear,a.EnrollSemester,a.EnrollTypeID
                    ,a.DayfgID,a.ClassTypeID,a.UnitID,a.StudyGroupID
                    ,COUNT(1) ReservationAmt
                    from tStuNewStudent a
                    where newstdstate='3'
                    group by a.EnrollYear,a.EnrollSemester,a.EnrollTypeID
                    ,a.DayfgID,a.ClassTypeID,a.UnitID,a.StudyGroupID
                ) d
                    on a.EnrollYear=d.EnrollYear
                    and a.Semester=d.EnrollSemester
                    and a.EnrollTypeID=d.EnrollTypeID
                    and a.DayfgID=d.DayfgID
                    and a.ClassTypeID=d.ClassTypeID
                    and a.UnitID=d.UnitID
                    and a.StudyGroupID=d.StudyGroupID
                left join tDayfg e on a.DayfgID = e.DayfgID
                left join tClassType f on a.ClassTypeID = f.ClassTypeID
                left join tUnitYear g on a.UnitID = g.UnitID
                left join tUnit h on g.upper = h.UnitID
                left join tStudyGroup i on a.StudyGroupID = i.StudyGroupID
                left join tEnrEnrollType j on a.EnrollTypeID = j.EnrollTypeID
                where {$sWhere}
                ";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

}
