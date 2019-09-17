<?php

namespace App\Database\ACAD\tStuNewStudent\Repo;

use App\Alltop\BaseModel;
use Illuminate\Support\Facades\DB;

class tStuNewStudentRepo
{
    public $aField = array();

    public function __construct()
    {
        $this->DB                   = "ACAD";
        $this->Table                = "tStuNewStudent";
        $this->Msg                  = "新生基本資料";
        $this->aField["newStuData"] = array_keys(array(
            "a.NewStdID"                            => "新生ID",
            "a.IsAdmin"                             => "錄取否",
            "a.ChtName"                             => "姓名",
            "a.EngName"                             => "英文姓名",
            "a.Sex"                                 => "性別",
            "a.Birthday"                            => "生日",
            "a.Birthplace"                          => "出生地",
            "a.OverseasID"                          => "所屬國家之身分字號",
            "a.PersonalID"                          => "身分證字號",
            "a.LowIncomeKind"                       => "中低/低收入戶",
            "a.DisabilitiesLevelID"                 => "身心障礙程度",
            "a.DisabilitiesID"                      => "身心障礙類別",
            "a.ResidentPermit"                      => "居留證統一編號",
            "a.AborigineKindID"                     => "原住民族別",
            "a.AborigineType"                       => "原住民註記",
            "a.OverseasAddress"                     => "國外僑居地 居住地址",
            "a.NationID"                            => "國籍/僑居地",
            "a.Passport"                            => "護照號碼",
            "a.EnterDateYear"                       => "入學民國年",
            "a.EnterDateMonth"                      => "入學月份",
            "a.ExGraduateUnitName"                  => "入學前系所名稱",
            "a.ExGraduateSchoolName"                => "入學前校名",
            "a.EnrollYear"                          => "入學學年",
            "a.EnrollSemester"                      => "入學學期",
            "a.EnrollType"                          => "名額核定類別",
            "a.DayfgID"                             => "入學部別ID",
            "a.ClassTypeID"                         => "入學學制ID",
            "a.UnitID"                              => "入學系所ID",
            "a.StudyGroupID"                        => "入學組別ID",
            "a.EnterGrade"                          => "入學年級",
            "a.ClassNo"                             => "入學班級",
            "a.StudentNo"                           => "學號",
            "a.ExamNo"                              => "准考證號碼",
            "a.ExGraduateYear"                      => "入學前畢業民國年",
            "a.ExGraduateMonth"                     => "入學前畢業月份",
            "a.ExGraduateSchoolID"                  => "入學前畢業學校",
            "a.ExGraduateType"                      => "畢肄業",
            "a.FeeKind"                             => "費用別",
            "a.EnrollTypeID"                        => "入學管道",
            "a.EntryIdentityID"                     => "入學身分",
            "a.EducationLevel"                      => "教育層級",
            "a.IsFreshGraduate"                     => "應屆畢業否",
            "a.ResidenceAddress"                    => "戶籍地址",
            "a.ResidenceZipCode"                    => "戶籍郵區",
            "a.ResidencePhone"                      => "戶籍電話",
            "a.CellPhone"                           => "通訊手機",
            "a.MailingAddress"                      => "通訊地址",
            "a.MailingZipCode"                      => "通訊郵區",
            "a.MailingPhone"                        => "通訊電話",
            "a.Email"                               => "電子信箱",
            "a.Emergency"                           => "緊急聯絡人",
            "a.EmergencyAddress"                    => "緊急聯絡人地址",
            "a.EmergencyCellPhone"                  => "緊急聯絡人行動電話",
            "a.EmergencyEmail"                      => "緊急聯絡人電子信箱",
            "a.EmergencyPhone"                      => "緊急聯絡人電話",
            "a.EmergencyProfessionID"               => "緊急聯絡人職業",
            "a.EmergencyRelationID"                 => "緊急聯絡人關係",
            "a.DistributionServiceArea"             => "公費生分發服務地區",
            "a.GovernmentSubsidiesDate"             => "受理公費期間",
            "a.DistributionNo"                      => "核准分發文號",
            "a.DistributionDate"                    => "核准分發日期",
            "a.EnglishListening"                    => "英聽",
            "a.BasicCompetenceTestNatural"          => "學測自然",
            "a.BasicCompetenceTestSocial"           => "學測社會",
            "a.BasicCompetenceTestEnglish"          => "學測英文",
            "a.BasicCompetenceTestChinese"          => "學測國文",
            "a.BasicCompetenceTestMath"             => "學測數學",
            "a.BasicCompetenceTestTotalScore"       => "學測總級分",
            "a.SpecifiedSubjectsTotalScore"         => "指考採計加權總分",
            "a.SpecifiedSubjectsCitizenshipSociety" => "指考公民與社會",
            "a.SpecifiedSubjectsChemistry"          => "指考化學",
            "a.SpecifiedSubjectsBiology"            => "指考生物",
            "a.SpecifiedSubjectsGeography"          => "指考地理",
            "a.SpecifiedSubjectsPhysical"           => "指考物理",
            "a.SpecifiedSubjectsEnglish"            => "指考英文",
            "a.SpecifiedSubjectsChinese"            => "指考國文",
            "a.SpecifiedSubjectsMathB"              => "指考數學乙",
            "a.SpecifiedSubjectsMathA"              => "指考數學甲",
            "a.SpecifiedSubjectsHistory"            => "指考歷史",
            "a.MusicMajorMusicalInstruments"        => "音樂術科主修樂器",
            "a.MusicMinorMusicalInstruments"        => "音樂術科副修樂器",
            "a.ArtCalligraphyPainting"              => "術科美術－水墨書畫",
            "a.ArtAppreciation"                     => "術科美術－美術鑑賞",
            "a.ArtSketch"                           => "術科美術－素描",
            "a.ArtPaintTechnique"                   => "術科美術－彩繪技法",
            "a.ArtCreativePerformance"              => "術科美術－創意表現",
            "a.TechnicalMusicMajor"                 => "術科音樂－主修",
            "a.TechnicalMusicMinor"                 => "術科音樂－副修",
            "a.TechnicalMusicSing"                  => "術科音樂－視唱",
            "a.TechnicalMusicTheory"                => "術科音樂－樂理",
            "a.TechnicalMusicDictation"             => "術科音樂－聽寫",
            "a.TechnicalSports"                     => "術科體育",
            "a.AdmissionOrder"                      => "考生錄取志願序",
            "a.JointExamEnglish"                    => "統測英文原級分",
            "a.JointExamChinese"                    => "統測國文原級分",
            "a.JointExamProfessionA"                => "統測專業一原級分",
            "a.JointExamProfessionB"                => "統測專業二原級分",
            "a.JointExamMath"                       => "統測數學原級分",
            "a.JointExamScore"                      => "統測總級分",
            "a.ResidenceVill"                       => "戶籍村里",
            "a.MailingRoad"                         => "通訊路名",
            "a.ResidenceRoad"                       => "戶籍路名",
            "a.MailingNeb"                          => "通訊鄰",
            "a.ResidenceNeb"                        => "戶籍鄰",
            "a.MailingVill"                         => "通訊村里",
            "a.ResidenceCity"                       => "戶籍縣市",
            "a.ResidenceDistrict"                   => "戶籍鄉鎮區",
            "a.MailingCity"                         => "通訊縣市",
            "a.MailingDistrict"                     => "通訊鄉鎮區",
            "a.BeingPayment"                        => "產生繳費單否",
            "a.AdmissionType"                       => "正/備取",
            "a.AdmissionSeq"                        => "備取序",
            "a.AdmissionMemo"                       => "流用備註",
            "a.NewStdState"                         => "新生狀態",
            "a.ExpertiseArea"                       => "專長條件",
            "a.ExGraduateUnitID"                    => "入學前系所代碼",
            "b.DayfgName"                           => "部別名稱",
            "c.ClassTypeName"                       => "學制名稱",
            "d.UnitName"                            => "科系名稱",
            "e.UnitName AS CollegeName"             => "學院名稱",
            "f.StudyGroupName"                      => "組別名稱",
            "g.EnrollTypeName"                      => "入學管道名稱",
            "i.ClassName"                           => "班級名稱",

        ));
        $this->aField['newStuDataOverview'] = array_keys(array(
            "a.NewStdID"       => "新生ID",
            "g.EnrollTypeName" => "入學管道名稱",
            "a.StudentNo"      => "學號",
            "a.ChtName"        => "姓名",
            "a.PersonalID"     => "身分證字號",
            "c.ClassTypeName"  => "學制名稱",
            "d.UnitName"       => "科系名稱",
            "a.ClassNo"        => "入學班級",
            "a.CellPhone"      => "通訊手機",
            "a.NewStdState"    => "新生狀態",
        ));
    }

    //新生資料概要
    public function newStuDataOverview($aParams = array())
    {
        $sSelect = implode(', ', $this->aField['newStuDataOverview']);

        $sTable = $this->Table;

        $aCondition = BaseModel::setWhere($aParams);
        $sWhere     = $aCondition['where'];
        $aParam     = $aCondition['param'];

        $sSql = "
        SELECT {$sSelect}
          FROM {$sTable} a
     LEFT JOIN tDayfg b ON a.DayfgID = b.DayfgID
     LEFT JOIN tClassType c ON a.ClassTypeID = c.ClassTypeID
     LEFT JOIN tUnitYear d ON a.UnitID = d.UnitID AND a.EnrollYear = d.ACADYear
     LEFT JOIN tUnit e ON d.upper = e.UnitID
     LEFT JOIN tStudyGroup f ON a.StudyGroupID = f.StudyGroupID
     LEFT JOIN tEnrEnrollType g ON a.EnrollTypeID = g.EnrollTypeID
     LEFT JOIN tUnit h ON a.UnitID = h.UnitID
         WHERE {$sWhere}
      ORDER BY b.Dayfg, c.ClassType, h.UnitNo";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //新生詳細資料
    public function newStuData($aParams = array())
    {
        $sSelect = implode(', ', $this->aField['newStuData']);

        $sTable = $this->Table;

        $aCondition = BaseModel::setWhere($aParams);
        $sWhere     = $aCondition['where'];
        $aParam     = $aCondition['param'];

        $sSql = "
        SELECT {$sSelect}
          FROM {$sTable} a
     LEFT JOIN tDayfg b ON a.DayfgID = b.DayfgID
     LEFT JOIN tClassType c ON a.ClassTypeID = c.ClassTypeID
     LEFT JOIN tUnitYear d ON a.UnitID = d.UnitID AND a.EnrollYear = d.ACADYear
     LEFT JOIN tUnit e ON d.upper = e.UnitID
     LEFT JOIN tStudyGroup f ON a.StudyGroupID = f.StudyGroupID
     LEFT JOIN tEnrEnrollType g ON a.EnrollTypeID = g.EnrollTypeID
     LEFT JOIN tClass h ON a.DayfgID = h.DayfgID
                       AND a.ClassTypeID = h.ClassTypeID
                       AND a.UnitID = h.UnitID
                       AND a.EnterGrade = h.Grade
                       AND a.ClassNo = h.ClassNo
     LEFT JOIN tClassYear i ON h.ClassID = i.ClassID
                           AND a.EnrollYear = i.ACADYear
                           AND a.EnrollSemester = i.Semester
         WHERE {$sWhere}
      ORDER BY b.Dayfg, c.ClassType, h.UnitNo";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //新生狀態-已報到(轉到學籍(tStudent)、班級歷程表(tStudentClassHist))
    public function insertStudent($aParams = array())
    {
        $sTable     = $this->Table;
        $aCondition = BaseModel::setWhere($aParams);
        $sWhere     = $aCondition['where'];
        $aParam     = $aCondition['param'];

        $sSql = "
        INSERT INTO tStudent (
            NewStdID, IsAdmin, ChtName, EngName, Sex, Birthday, Birthplace, OverseasID, PersonalID,
            LowIncomeKind, DisabilitiesLevelID, DisabilitiesID, ResidentPermit, AborigineKindID, AborigineType,
            OverseasAddress, NationID, Passport, EnterDateYear, EnterDateMonth, ExGraduateUnitName,
            ExGraduateSchoolName, EnrollYear, EnrollSemester, EnrollType, DayfgID, ClassTypeID, UnitID,
            StudyGroupID, EnterGrade, ClassNo, StudentNo, ExamNo, ExGraduateYear, ExGraduateMonth,
            ExGraduateSchoolID, ExGraduateType, FeeKind, EnrollTypeID, EntryIdentityID, EducationLevel,
            IsFreshGraduate, ResidenceAddress, ResidenceZipCode, ResidencePhone, CellPhone, MailingAddress,
            MailingZipCode, MailingPhone, Email, Emergency, EmergencyAddress, EmergencyCellPhone, EmergencyEmail,
            EmergencyPhone, EmergencyProfessionID, EmergencyRelationID, DistributionServiceArea, GovernmentSubsidiesDate,
            DistributionNo, DistributionDate, ResidenceVill, MailingRoad, ResidenceRoad, MailingNeb, ResidenceNeb,
            MailingVill, ResidenceCity, ResidenceDistrict, MailingCity, MailingDistrict, AdmissionType,
            AdmissionSeq, AdmissionMemo, ExGraduateUnitID
        )
        SELECT NewStdID, IsAdmin, ChtName, EngName, Sex, Birthday, Birthplace, OverseasID, PersonalID,
                LowIncomeKind, DisabilitiesLevelID, DisabilitiesID, ResidentPermit, AborigineKindID, AborigineType,
                OverseasAddress, NationID, Passport, EnterDateYear, EnterDateMonth, ExGraduateUnitName,
                ExGraduateSchoolName, EnrollYear, EnrollSemester, EnrollType, DayfgID, ClassTypeID, UnitID,
                StudyGroupID, EnterGrade, ClassNo, StudentNo, ExamNo, ExGraduateYear, ExGraduateMonth,
                ExGraduateSchoolID, ExGraduateType, FeeKind, EnrollTypeID, EntryIdentityID, EducationLevel,
                IsFreshGraduate, ResidenceAddress, ResidenceZipCode, ResidencePhone, CellPhone, MailingAddress,
                MailingZipCode, MailingPhone, Email, Emergency, EmergencyAddress, EmergencyCellPhone, EmergencyEmail,
                EmergencyPhone, EmergencyProfessionID, EmergencyRelationID, DistributionServiceArea, GovernmentSubsidiesDate,
                DistributionNo, DistributionDate, ResidenceVill, MailingRoad, ResidenceRoad, MailingNeb, ResidenceNeb,
                MailingVill, ResidenceCity, ResidenceDistrict, MailingCity, MailingDistrict, AdmissionType,
                AdmissionSeq, AdmissionMemo, ExGraduateUnitID
        FROM tStuNewStudent
        Where {$sWhere}
        ";
        return DB::connection('ACAD')->insert($sSql, $aParam);
    }

    //新生狀態-已報到(轉到學籍(tStudent)、班級歷程表(tStudentClassHist))
    public function insertStuClassHist($aParams = array())
    {
        $aParam = array();

        $sTable = $this->Table;
        // $aCondition = BaseModel::setWhere($aParams);
        // $sWhere     = $aCondition['where'];

        $aParam = array_values($aParams);
        //拿掉ClassState 避免產生SELECT 值的數量必須與 INSERT 資料行的數量相符
        $sSql = "
        DECLARE @ACADYear varchar(50) = ?, @Semester varchar(50) = ?;
        DECLARE @DayfgID varchar(50) = ?, @ClassTypeID varchar(50) = ?, @UnitID varchar(50) = ?, @StudyGroupID varchar(50) = ?;
        DECLARE @StartGrade int = ?, @ClassNo varchar(50) = ?, @StudentID varchar(50) = ?;
        DECLARE @IsRegistered varchar(2) = ?;
        DECLARE @MaxYears int = (
            select top 1 case when ExtraYears is null
                then MinYears else ExtraYears end MaxYears
            from tUnitClassType where DayfgID = @DayfgID and ClassTypeID = @ClassTypeID and UnitID = @UnitID);
        DECLARE @seq varchar(5) = (select seq from tSemester where Semester=@Semester);

        With vGradeHist(Grade) AS (
                select @StartGrade as Grade
                union all
                select Grade+1 as Grade
                from vGradeHist
                where Grade < @MaxYears
            ),
            Hist AS (
                /* 用數字表作學年學期展開 */
                select right('000' + cast(@ACADYear + a.Grade - @StartGrade  as varchar(3)), 3) Year
                ,b.Semester,@DayfgID as DayfgID,@ClassTypeID as ClassTypeID,@UnitID as UnitID
                , @StudyGroupID as StudyGroupID, a.Grade, @ClassNo ClassNo ,b.seq
                from vGradeHist a, tSemester b
            )
        INSERT INTO tStuStdClassHist (
                Year, Semester, StudentID, DayfgID, ClassTypeID, UnitID, StudyGroupID,
                Grade, ClassNo, StdState, ClassID, IsRegistered, ClassUniqueNo
        )
        SELECT a.Year, a.Semester, @StudentID, a.DayfgID, a.ClassTypeID, a.UnitID, a.StudyGroupID
            , a.Grade, a.ClassNo, 'S', b.ClassID, @IsRegistered, b.ClassUniqueNo
        FROM Hist a
        LEFT JOIN tClass b /* 找出班級 (用 left 是為了讓 [招生] 沒有班級代碼的資料，也能長班級歷程)*/
                on a.DayfgID = b.DayfgID and a.ClassTypeID = b.ClassTypeID and a.UnitID = b.UnitID
                and a.StudyGroupID = b.StudyGroupID and a.Grade = b.Grade and a.ClassNo = b.ClassNo
        ";

        return DB::connection('ACAD')->insert($sSql, $aParam);
    }

}
