<?php

namespace App\Database\ACAD\tSchoolEdu\Model;

use Illuminate\Database\Eloquent\Model;

class tSchoolEdu extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tSchoolEdu';

    public $timestamps = false;

    public $primaryKey   = 'SchoolID';
    public $incrementing = false;
    public $casts        = array(
        'SchoolID' => 'string',
    );

    public $fillable = array(
        'SchoolID', 'SchoolName', 'SchoolAlias', 'GraduateLevelID',
        'state', 'Address', 'Phone', 'Email', 'EduSchoolNo',
    );
}
