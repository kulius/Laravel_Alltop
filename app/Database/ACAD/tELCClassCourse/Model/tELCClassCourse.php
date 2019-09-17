<?php

namespace App\Database\ACAD\tELCClassCourse\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class tELCClassCourse extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tELCClassCourse';

    public $timestamps = false;

    public $primaryKey = 'ClassCourseID';

    public $fillable = array(
        'TWYear',
        'Season',
        'ClassID',
        'CourseID',
        'ClassCourseName',
        'ClassCourseEngName',
        'CourseDateFirst',
        'CourseDateLast',
        'UpdateID',
        'UpdateDate',
        'ClassCourseNo',
        'CourseMemo',
        'ClassCourseHour',
        'ClassRoomID',
    );

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->ClassCourseNo) {
                $aClassNo             = DB::connection('ACAD')->select("select RIGHT( '00000' + CAST(count(*) AS NVARCHAR), 5) AS ClassNo from tELCClassCourse");
                $model->ClassCourseNo = $aClassNo[0]['ClassNo'];
            }

            $model->UpdateID   = Session::get('user_id');
            $model->UpdateDate = Carbon::now();
        });

        static::updating(function ($model) {
            $model->UpdateID   = Session::get('user_id');
            $model->UpdateDate = Carbon::now();
        });
    }

    public function teacher()
    {
        return $this->hasOne('App\Database\ACAD\tELCClassCourseTeacher\Model\tELCClassCourseTeacher', 'ClassCourseID', 'ClassCourseID');
    }

    public function classCourseDate()
    {
        return $this->belongsTo('App\Database\ACAD\tELCClassCourseTeacherDate\Model\tELCClassCourseTeacherDate', 'ClassCourseID', 'ClassCourseID');
    }

    public function classStudents()
    {
        return $this->hasMany('App\Database\ACAD\tELCClassStd\Model\tELCClassStd', 'ClassID', 'ClassID');
    }

    public function courseStudents()
    {
        return $this->hasMany('App\Database\ACAD\tELCClassStdScore\Model\tELCClassStdScore', 'ClassCourseID', 'ClassCourseID');
    }
}
