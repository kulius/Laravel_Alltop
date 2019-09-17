<?php

namespace App\Database\ACAD\tELCClassCourseTeacher\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tELCClassCourseTeacher extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tELCClassCourseTeacher';

    public $timestamps = false;

    public $primaryKey = 'ClassCourseTeacherID';

    public $casts = array(
    );

    // public $incrementing = false;

    public $fillable = array(
        'ClassCourseTeacherID',
        'ClassCourseID',
        'Emp_ID',
        'TeacherName',
        'TeacherEngName',
        'TeachHour',
        'UpdateID',
        'UpdateDate',
        'TeacherMemo',
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
