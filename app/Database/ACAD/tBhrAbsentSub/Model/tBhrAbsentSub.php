<?php

namespace App\Database\ACAD\tBhrAbsentSub\Model;

use Illuminate\Database\Eloquent\Model;

class tBhrAbsentSub extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tBhrAbsentSub';

    public $timestamps = false;

    public $primaryKey = 'AbsentSubID';

    public $incrementing = true;

    public $fillable = array(
        'ACADYear',
        'Semester',
        'DayfgID',
        'ClassTypeID',
        'MeetingKindID',
        'LeaveKindID',
        'SubModle',
        'SubModleValue',
        'NoCountSection',
        'ApplyID',
        'ApplyDate',
        'UpdateID',
        'UpdateDate',
    );

    public $casts = array(
        'AbsentSubID' => 'string',
    );

    //新增時產生GUID
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {

    //         if (!$model->AbsentSubID) {
    //             // only set a UUID on first creation and if not already set
    //             $model->AbsentSubID = (string) Str::uuid();
    //         }
    //     });
    // }
}
