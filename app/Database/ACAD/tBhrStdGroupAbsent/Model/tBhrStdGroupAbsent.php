<?php

namespace App\Database\ACAD\tBhrStdGroupAbsent\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tBhrStdGroupAbsent extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tBhrStdGroupAbsent';

    public $timestamps = false;

    public $primaryKey = 'StdGroupAbsentID';

    // public $incrementing = false;

    public $fillable = array(
        "ACADYear",
        "Semester",
        "DEPNO",
        "LeaveKindID",
        "LeaveReason",
        "LeaveDateBeg",
        "LeaveDateEnd",
        "FormNo",
        "status",
        "ApplyID",
        "ApplyDate",
        "UpdateID",
        "UpdateDate",
    );

    // public $casts = array(
    //     'StdGroupAbsentID' => 'string',
    // );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // if (!$model->StdGroupAbsentID) {
            //     // only set a UUID on first creation and if not already set
            //     $model->StdGroupAbsentID = (string) Str::uuid();
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
