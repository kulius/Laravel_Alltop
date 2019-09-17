<?php

namespace App\Database\ACAD\tCampStudent\Model;

use Illuminate\Database\Eloquent\Model;

class tCampStudent extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tCampStudent';

    public $timestamps = false;

    public $primaryKey = 'StudentID';

    public $casts = array(

    );

    public $fillable = array(
        'SessionNo',
        'GroupYN',
        'StdStateCamp',
        'GroupMember1',
        'GroupMember2',
        'GroupMember3',
        'GroupMember4',
        'FirstName',
        'MiddleName',
        'LastName',
        'ChtName',
        'NationID',
        'Sex',
        'Birthday',
        'Age',
        'Passport',
        'Guardian',
        'GuardianRelationID',
        'GuardianPhone',
        'GuardianCellPhone',
        'GuardianInTWN',
        'GuardianContactInformation',
        'ResidenceZipCode',
        'ResidenceNationID',
        'ResidenceAddress',
        'Email',
        'Emergency',
        'EmergencyRelationID',
        'EmergencyPhone',
        'EmergencyCellPhone',
        'EmergencyEmail',
        'SpecialEduNeedsYN',
        'SpecialEduNeeds',
        'CampDietNo',
        'DietRequirements',
        'MedicalConditionYN',
        'MedicalCondition',
        'CampTShirtSize',
        'NativeLanguage',
        'OtherLanguage',
        'StdyChineseYN',
        'HowLongStdyChinese',
        'StdyFont',
        'MainSubjectNo',
        'IsTuitionPaid',
        'IsStudentCard',
    );

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->StdStateCamp = '1';
        });
    }
}
