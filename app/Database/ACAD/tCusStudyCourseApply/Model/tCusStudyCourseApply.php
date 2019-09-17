<?php

namespace App\Database\ACAD\tCusStudyCourseApply\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class tCusStudyCourseApply extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tCusStudyCourseApply';

    public $timestamps = false;

    public $primaryKey = 'StudyCourseApply';

    public $casts = array(
    );

    public $fillable = array(
        'StudentID',
        'StudyCourseID',
        'Approver',
        'ApprovalDate',
        'ApproveStatus',
        'UpdateID',
        'UpdateDate',
        'BreedTeacher',
        'StudyYear',
        'StudySemester',
        'GiveUpYear',
        'GiveUpSemester',
        'GiveUpDate',
        'FinishYear',
        'FinishSemester',
        'FinishDate',
        'FinishNo',
        'state',
        'StudyKind',
        'StudyGroupID',
        'UnitClassTypeID',
    );
    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->StudyCourseApply) {
                // only set a UUID on first creation and if not already set
                $model->StudyCourseApply = (string) Str::uuid();
            }

            if (!$model->StudyKind) {
                $model->StudyKind = '4';
            }
            if (!$model->Approver) {
                $model->Approver = Session::get('user_id');
            }
            if (!$model->BreedTeacher) {
                $model->BreedTeacher = '0';
            }
            if (!$model->ApproveStatus) {
                $model->ApproveStatus = '3';
            }

            $model->UpdateID   = Session::get('user_id');
            $model->UpdateDate = Carbon::now();
        });

        static::updating(function ($model) {
            $model->UpdateID   = Session::get('user_id');
            $model->UpdateDate = Carbon::now();
        });
    }

    public function StudyCourse()
    {
        return $this->hasOne('App\Database\ACAD\tCusStudyCourse\Model\tCusStudyCourse', 'StudyCourseID', 'StudyCourseID');
    }
}
