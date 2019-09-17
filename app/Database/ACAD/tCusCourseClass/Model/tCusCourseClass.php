<?php

namespace App\Database\ACAD\tCusCourseClass\Model;

use Illuminate\Database\Eloquent\Model;

class tCusCourseClass extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tCusCourseClass';

    public $timestamps = false;

    public $primaryKey = 'CourseClassID';

    public $casts = array(
    );

    public $fillable = array(
        'CourseClassName',
        'Choose',
        'CourseClassAlias',
        'CourseNoEdu',
        'state',
        'StudyCourseSeq',
        'IsOfficial',
        'IsDeduct',
        'StudyCourseCheckCondition',
        'IsUnitEdit',
    );

}
