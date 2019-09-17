<?php

namespace App\Database\ACAD\vStuStudentAll\Model;

use Illuminate\Database\Eloquent\Model;

class vStuStudentAll extends Model
{
    protected $connection = 'ACAD';

    public $table = 'vStuStudentAll';

    public $timestamps = false;

    public $primaryKey = 'StudentID';

    public $casts = array(
    );

    public $fillable = array(
    );

}
