<?php

namespace App\Database\ACAD\tCouTutor\Model;

use Illuminate\Database\Eloquent\Model;

class tCouTutor extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tCouTutor';

    public $timestamps = false;

    public $primaryKey = 'CouTutorID';

    public $incrementing = true;

    public $fillable = array(
        'ACADYear',
        'Semester',
        'StudentID',
        'ClassTypeID',
        'CouTimeStart',
        'CouTimeEnd',
        'BriefContent',
        'ApplyID',
        'ApplyDate',
        'UpdateID',
        'UpdateDate',
    );

    public $casts = array(
        'ParaID' => 'string',
    );

    //新增時產生GUID
    //protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {

    //         if (!$model->ParaID) {
    //             // only set a UUID on first creation and if not already set
    //             $model->ParaID = (string) Str::uuid();
    //         }
    //     });
    // }
}
