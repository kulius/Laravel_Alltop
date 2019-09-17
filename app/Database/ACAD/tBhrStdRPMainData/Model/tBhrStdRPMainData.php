<?php

namespace App\Database\ACAD\tBhrStdRPMainData\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tBhrStdRPMainData extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tBhrStdRPMainData';

    public $timestamps = false;

    public $primaryKey = 'StdRPMainDataID';

    // public $incrementing = false;

    public $fillable = array(
        "ACADYear",
        "Semester",
        "status",
        "FormNo",
        "ApplyID",
        "ApplyDate",
        "UpdateID",
        "UpdateDate",
    );

    // public $casts = array(
    //     'StdRPMainDataID' => 'string',
    // );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // if (!$model->StdRPMainDataID) {
            //     // only set a UUID on first creation and if not already set
            //     $model->StdRPMainDataID = (string) Str::uuid();
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
