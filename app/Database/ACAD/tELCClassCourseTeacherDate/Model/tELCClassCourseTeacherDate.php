<?php

namespace App\Database\ACAD\tELCClassCourseTeacherDate\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tELCClassCourseTeacherDate extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tELCClassCourseTeacherDate';

    public $timestamps = false;

    public $primaryKey = 'AutoNo';

    // public $casts = array(
    //     'ClassCourseID' => 'string',
    // );

    // public $incrementing = true;

    public $fillable = array(
        'ClassCourseID',
        'Emp_ID',
        'DayKind',
        'SectionSeq',
    );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->UpdateID   = Session::get('user_id');
            $model->UpdateDate = Carbon::now();
        });

        static::updating(function ($model) {
            $model->UpdateID   = Session::get('user_id');
            $model->UpdateDate = Carbon::now();
        });
    }

}
