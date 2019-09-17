<?php

namespace App\Database\ACAD\Model\tStuNewStudent\Model;

use Illuminate\Database\Eloquent\Model;

class tStuNewStudent extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tStuNewStudent';

    public $timestamps = false;

    public $primaryKey = 'NewStdID';

    public $casts = array(
        // 'NewStdID' => 'string',
        // 'DisabilitiesLevelID' => 'integer',
    );

    // public $incrementing = false;

    public $fillable = array(
        'IsAdmin',
        'ChtName',
        'EngName',
        'Sex',
        'Birthday',
        'Birthplace',
        'OverseasID',
        'PersonalID',
        'LowIncomeKind',
        'DisabilitiesLevelID',
        'DisabilitiesID',
        'ResidentPermit',
        'AborigineKindID',
        'AborigineType',
        'OverseasAddress',
        'NationID',
        'Passport',
        'EnterDateYear',
        'EnterDateMonth',
        'ExGraduateUnitName',
        'ExGraduateSchoolName',
        'EnrollYear',
        'EnrollSemester',
        'EnrollType',
        'DayfgID',
        'ClassTypeID',
        'UnitID',
        'StudyGroupID',
        'EnterGrade',
        'ClassNo',
        'StudentNo',
        'ExamNo',
        'ExGraduateYear',
        'ExGraduateMonth',
        'ExGraduateSchoolID',
        'ExGraduateType',
        'FeeKind',
        'EnrollTypeID',
        'EntryIdentityID',
        'EducationLevel',
        'IsFreshGraduate',
        'ResidenceAddress',
        'ResidenceZipCode',
        'ResidencePhone',
        'CellPhone',
        'MailingAddress',
        'MailingZipCode',
        'MailingPhone',
        'Email',
        'Emergency',
        'EmergencyAddress',
        'EmergencyCellPhone',
        'EmergencyEmail',
        'EmergencyPhone',
        'EmergencyProfessionID',
        'EmergencyRelationID',
        'DistributionServiceArea',
        'GovernmentSubsidiesDate',
        'DistributionNo',
        'DistributionDate',
        'EnglishListening',
        'BasicCompetenceTestNatural',
        'BasicCompetenceTestSocial',
        'BasicCompetenceTestEnglish',
        'BasicCompetenceTestChinese',
        'BasicCompetenceTestMath',
        'BasicCompetenceTestTotalScore',
        'SpecifiedSubjectsTotalScore',
        'SpecifiedSubjectsCitizenshipSociety',
        'SpecifiedSubjectsChemistry',
        'SpecifiedSubjectsBiology',
        'SpecifiedSubjectsGeography',
        'SpecifiedSubjectsPhysical',
        'SpecifiedSubjectsEnglish',
        'SpecifiedSubjectsChinese',
        'SpecifiedSubjectsMathB',
        'SpecifiedSubjectsMathA',
        'SpecifiedSubjectsHistory',
        'MusicMajorMusicalInstruments',
        'MusicMinorMusicalInstruments',
        'ArtCalligraphyPainting',
        'ArtAppreciation',
        'ArtSketch',
        'ArtPaintTechnique',
        'ArtCreativePerformance',
        'TechnicalMusicMajor',
        'TechnicalMusicMinor',
        'TechnicalMusicSing',
        'TechnicalMusicTheory',
        'TechnicalMusicDictation',
        'TechnicalSports',
        'AdmissionOrder',
        'JointExamEnglish',
        'JointExamChinese',
        'JointExamProfessionA',
        'JointExamProfessionB',
        'JointExamMath',
        'JointExamScore',
        'ResidenceVill',
        'MailingRoad',
        'ResidenceRoad',
        'MailingNeb',
        'ResidenceNeb',
        'MailingVill',
        'ResidenceCity',
        'ResidenceDistrict',
        'MailingCity',
        'MailingDistrict',
        'BeingPayment',
        'AdmissionType',
        'AdmissionSeq',
        'AdmissionMemo',
        'NewStdState',
        'ExpertiseArea',
        'ExGraduateUnitID',
        'SpecialIdentityMemo',
    );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->NewStdState = '1';
        });

        static::updating(function ($model) {

        });
    }
}
