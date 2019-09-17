<?php

namespace App\Database\ACAD\tBhrDirTutor\Model;

use Illuminate\Database\Eloquent\Model;

class tBhrDirTutor extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tBhrDirTutor';

    public $timestamps = false;

    public $primaryKey = 'DirTutorID';

    public $incrementing = true;

    public $fillable = array(
        'ACADYear',
        'Semester',
        'DayfgID',
        'ClassTypeID',
        'UnitID',
        'DirTeacherID',
        'DirTeacherEmail',
        'DirTeacherPhone',
        'DirEmploymentState',
        'DirEmpStartTime',
        'DirEmpEndTime',
        'DirStatus',
        'UpdateID',
        'UpdateDate',
    );

    public $casts = array(
        'DirTutorID' => 'string',
    );

    //新增時產生GUID
    //protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {

    //         if (!$model->DirTutorID) {
    //             // only set a UUID on first creation and if not already set
    //             $model->DirTutorID = (string) Str::uuid();
    //         }
    //     });
    // }
}
