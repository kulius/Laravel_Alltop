<?php

namespace App\Database\ACAD\tStudentFamily\Model;

use Illuminate\Database\Eloquent\Model;

class tStudentFamily extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tStudentFamily';

    public $timestamps = false;

    public $primaryKey = 'StudentID';

    public $casts = array(
    );

    public $fillable = array(
        'StudentID',
        'FamilyRelationShip',
        'ChtName',
        'PersonalID',
        'ComPhone',
        'BirthDay',
        'Phone',
        'CellPhone',
        'Address',
        'AddressVill',
        'AddressNeb',
        'AddressRoad',
        'ZipCode',
        'LiveStatus',
        'Age',
        'EducationLevel',
        'AddressCity',
        'AddressDistrict',
        'NationID',
        'ProfesionalID',
        'BirthdayYear',
        'CompanyName',
        'WorkPosition',
        'ProfesionalID',
        'GraduateSchoolID',
        'GraduateSchoolName',
    );

}
