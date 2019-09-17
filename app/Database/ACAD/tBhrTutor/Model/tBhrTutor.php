<?php

namespace App\Database\ACAD\tBhrTutor\Model;

use Illuminate\Database\Eloquent\Model;

class tBhrTutor extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tBhrTutor';

    public $timestamps = false;

    public $primaryKey = 'TutorID';

    public $incrementing = true;

    public $fillable = array(
        'ACADYear',
        'Semester',
        'DayfgID',
        'ClassTypeID',
        'UnitID',
        'StudyGroupID',
        'Grade',
        'ClassID',
        'ClassNo',
        'TeacherID',
        'Phone',
        'TeacherEmail',
        'CounselorNo',
        'MilitaryNo',
        'EmploymentState',
        'EmpStartTime',
        'EmpEndTime',
        'TeacherEdu',
        'status',
        'UpdateID',
        'UpdateDate',
    );

    public $casts = array(
        'TutorID' => 'string',
    );

    //新增時產生GUID
    //protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {

    //         if (!$model->TutorID) {
    //             // only set a UUID on first creation and if not already set
    //             $model->TutorID = (string) Str::uuid();
    //         }
    //     });
    // }
}
