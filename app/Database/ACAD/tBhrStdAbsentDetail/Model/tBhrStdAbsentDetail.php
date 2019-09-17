<?php

namespace App\Database\ACAD\tBhrStdAbsentDetail\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tBhrStdAbsentDetail extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tBhrStdAbsentDetail';

    public $timestamps = false;

    public $primaryKey = 'StdAbsentDetailID';

    // public $incrementing = false;

    public $fillable = array(
        "StdAbsentID",
        "AbsentDate",
        "SectionSeq",
        "MeetingKindID",
        "UpdateID",
        "UpdateDate",
    );

    // public $casts = array(
    //     'StdAbsentDetailID' => 'string',
    // );

    public $rules = array(
        'StdAbsentID'   => 'required',
        'AbsentDate'    => 'required|date',
        'SectionSeq'    => 'required|max:3',
        'MeetingKindID' => 'required',
    );

    public $messages = array(
        'StdAbsentID.required'   => '請輸入學生請假單ID',
        'AbsentDate.required'    => '請輸入請假日期',
        'AbsentDate.date'        => '請假日期需為日期格式',
        'SectionSeq.required'    => '請輸入請假節次',
        'SectionSeq.max'         => '請假節次不可超過:max字',
        'MeetingKindID.required' => '請輸入勤缺程類別',
    );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // if (!$model->StdAbsentDetailID) {
            //     // only set a UUID on first creation and if not already set
            //     $model->StdAbsentDetailID = (string) Str::uuid();
            // }

            $model->UpdateID   = Session::get('user_id');
            $model->UpdateDate = Carbon::now();
        });

        static::updating(function ($model) {
            $model->UpdateID   = Session::get('user_id');
            $model->UpdateDate = Carbon::now();
        });
    }
}
