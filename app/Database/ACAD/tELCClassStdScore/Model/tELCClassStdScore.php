<?php

namespace App\Database\ACAD\tELCClassStdScore\Model;

use Illuminate\Database\Eloquent\Model;

class tELCClassStdScore extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tELCClassStdScore';

    public $timestamps = false;

    public $primaryKey = 'AutoNo';

    public $incrementing = true;

    public $fillable = array(
        'TWYear',
        'Season',
        'ClassID',
        'StudentID',
        'ClassCourseID',
        'Attendance',
        'HomeWork',
        'Participation',
        'FinalTest',
        'Quizzes',
        'Listening',
        'Speaking',
        'Reading',
        'Writing',
        'UpdateID',
        'UpdateDate',
    );

}
