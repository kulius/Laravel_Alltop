<?php

namespace App\Database\ACAD\tELCStudent\Model;

use Illuminate\Database\Eloquent\Model;

class tELCStudent extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tELCStudent';

    public $timestamps = false;

    public $primaryKey = 'StudentID';

    public $casts = array(
    );

    // public $incrementing = false;

    public $fillable = array(
        'StudentNo',
        'ChtName',
        'FirstName',
        'MiddleName',
        'LastName',
        'NationID',
        'Sex',
        'MarriageID',
        'Birthplace',
        'Birthday',
        'Passport',
        'ResidencePhone',
        'CellPhone',
        'ResidenceAddress',
        'MailingAddress',
        'Email',
        'LastEducation',
        'LastSchoolName',
        'Occupation',
        'NativeLanguage',
        'OtherLanguage',
        'StdyChineseYN',
        'HowLongStdyChinese',
        'StdyFont',
        'LearningMaterials',
        'StdStateELC',
        'EmergencyName',
        'EmergencyPhone',
        'EmergencyEmail',
        'TWYear',
        'Season',
        'LevelNo',
        'StdyChinesePlace',
        'ResidentPermit',
        'ExpectedSeason',
        'IsTuitionPaid',
        'IsStudentCard',
    );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

        });
    }
}
