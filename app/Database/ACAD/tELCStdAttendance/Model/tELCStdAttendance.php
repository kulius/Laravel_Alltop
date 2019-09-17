<?php

namespace App\Database\ACAD\tELCStdAttendance\Model;

use Illuminate\Database\Eloquent\Model;

class tELCStdAttendance extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tELCStdAttendance';

    public $timestamps = false;

    public $primaryKey = 'StudentID';

    // public $incrementing = true;

    public $fillable = array(
        'ClassCourseID',
        'StudentID',
        'SCDate',
        'AttendanceHours',
        'LateHours',
        'Illness',
        'PersonalleaveHours',
        'CutclassHours',
        'CourseHours',
        'UpdateID',
        'UpdateDate',
    );
}
