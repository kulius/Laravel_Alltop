<?php

namespace App\Database\ACAD\tSemester\Model;

use Illuminate\Database\Eloquent\Model;

class tSemester extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tSemester';

    public $timestamps = false;

    public $primaryKey = 'Semester';
    public $incrementing = false;
    public $casts = array(
        'Semester' => 'string',
    );

    public $fillable = array(
        'SemesterName', 'SemesterENGName', 'SemesterType',
        'Seq', 'SemesterGroup',
    );

}
