<?php

namespace App\Database\ACAD\tBhrStdAbsent\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tBhrStdAbsent extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tBhrStdAbsent';

    public $timestamps = false;

    public $primaryKey = 'StdAbsentID';

    // public $incrementing = false;

    public $fillable = array(
        "ACADYear",
        "Semester",
        "StudentID",
        "LeaveKindID",
        "LeaveReason",
        "LeaveDateBeg",
        "LeaveDateEnd",
        "FormNo",
        "status",
        "signstatus",
        "ApplyID",
        "ApplyDate",
        "UpdateID",
        "UpdateDate",
    );

    // public $casts = array(
    //     'StdAbsentID' => 'string',
    // );

    public $rules = array(
        'ACADYear'     => 'required|max:3',
        'Semester'     => 'required|max:2',
        'StudentID'    => 'required',
        'LeaveKindID'  => 'required',
        'LeaveReason'  => 'required|max:200',
        'LeaveDateBeg' => 'required|date',
        'LeaveDateEnd' => 'required|date',
        'FormNo'       => 'max:40',
        'status'       => 'required|max:2',
    );

    public $messages = array(
        'ACADYear.required'     => '請輸入學年',
        'ACADYear.max'          => '學年不可超過:max字',
        'Semester.required'     => '請輸入學期',
        'Semester.max'          => '學期不可超過:max字',
        'StudentID.required'    => '請輸入學生ID',
        'LeaveReason.required'  => '請輸入假由',
        'LeaveReason.max'       => '假由不可超過:max字',
        'LeaveDateBeg.required' => '請輸入請假日期(起)',
        'LeaveDateBeg.date'     => '請假日期(起)需為日期格式',
        'LeaveDateEnd.required' => '請輸入請假日期(訖)',
        'LeaveDateEnd.date'     => '請假日期(訖)需為日期格式',
        'FormNo.max'            => '簽核單號不可超過:max字',
        'status.required'       => '請輸入假單狀態',
        'status.max'            => '假單狀態不可超過:max字',
    );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // if (!$model->StdAbsentID) {
            //     // only set a UUID on first creation and if not already set
            //     $model->StdAbsentID = (string) Str::uuid();
            // }

            $model->ApplyID   = Session::get('user_id');
            $model->ApplyDate = Carbon::now();
        });

        static::updating(function ($model) {
            $model->UpdateID   = Session::get('user_id');
            $model->UpdateDate = Carbon::now();
        });
    }
}
