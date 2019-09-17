<?php

namespace App\Database\ACAD\tCusSelectedCourse\Model;

use Illuminate\Database\Eloquent\Model;

class tCusSelectedCourse extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tCusSelectedCourse';

    public $timestamps = false;

    public $primaryKey = 'SelectedCourseID';

    public $incrementing = true;

    public $fillable = array(
        'ACADYear',
        'Semester',
        'UpdateID',
        'UpdateDate',
        'SelectKind',
        'Memo',
        'IsWithdraw',
        'state',
        'Score',
        'IsMidAlarm',
        'PowerSeq',
        'CourseKind',
        'IsLock',
        'StopDate',
        'RegState',
        'RegMemo',
        'RegPublish',
        'ScoreUpdateID',
        'ScoreUpdateDate',
        'ReTryMemo',
        'IsScoreLock',
        'ScoreLockDate',
        'DelayDate',
        'unScoreable',
        'SUBJ_MARK',
        'OffCourseName',
        'OffSUBJ_ID',
        'SemesterCourseID',
        'StudentID',
    );

    public $casts = array(
        'SelectedCourseID' => 'string',
    );

    //新增時產生GUID
    //protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {

    //         if (!$model->SelectedCourseID) {
    //             // only set a UUID on first creation and if not already set
    //             $model->SelectedCourseID = (string) Str::uuid();
    //         }
    //     });
    // }
}
