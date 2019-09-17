<?php

namespace App\Database\ACAD\tStuStateChange\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tStuStateChange extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tStuStateChange';

    public $timestamps = false;

    public $primaryKey = 'ChangeLogID';

    public $fillable = array(
        'ACADYear',
        'Semester',
        'Memo',
        'ApplyDate',
        'ApprovedDate',
        'Grade',
        'ClassNo',
        'GradeOld',
        'ClassNoOld',
        'ChtName',
        'PersonalID',
        'BirthDay',
        'ChtNameOld',
        'PersonalIDOld',
        'BirthDayOld',
        'BackDate',
        'BeBackYear',
        'BeBackSemester',
        'ChangeKind',
        'ApprovedNo',
        'StudyKind',
        'Status',
        'SignStatus',
        'state',
        'UpdateDate',
        'UpdateID',
        'Score',
        'ScoreOld',
        'ApplyNo',
        'DIVS_ID',
        'DIVS_IDOld',
        'BackGrade',
        'BackClassNo',
        'ChangeLogID',
        'BackClassID',
        'BackClassTypeID',
        'BackDayfgID',
        'BackStudyGroupID',
        'BackUnitClassTypeID',
        'BackUnitID',
        'ChangeLogIDOld',
        'ChgReasonDetailID',
        'ChgReasonID',
        'ClassID',
        'ClassIDOld',
        'ClassTypeID',
        'ClassTypeIDOld',
        'DayfgID',
        'DayfgIDOld',
        'SemesterCourseID',
        'StudentID',
        'StudyCollegeID',
        'StudyGroupID',
        'StudyGroupIDOld',
        'StudyStudyGroupID',
        'StudyUnitID',
        'UnitClassTypeIDOld',
        'UnitID',
        'UnitIDOld',
        'ChgReasonID2',
        'ChgReasonDetailID2',
        'SuspendSemester',
    );

    public $casts = array(
        'ApplyDate'    => 'datetime:Y-m-d H:i',
        'ApprovedDate' => 'datetime:Y-m-d H:i',
    );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->ApplyDate  = Carbon::now();
            $model->UpdateID   = Session::get('user_id');
            $model->UpdateDate = Carbon::now();
        });

        static::updating(function ($model) {
            $model->UpdateID   = Session::get('user_id');
            $model->UpdateDate = Carbon::now();
        });
    }
}
