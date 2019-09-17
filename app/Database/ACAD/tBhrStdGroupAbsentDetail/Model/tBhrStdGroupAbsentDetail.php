<?php

namespace App\Database\ACAD\tBhrStdGroupAbsentDetail\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tBhrStdGroupAbsentDetail extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tBhrStdGroupAbsentDetail';

    public $timestamps = false;

    public $primaryKey = 'StdGroupAbsentDetailID';

    // public $incrementing = false;

    public $fillable = array(
        "StdGroupAbsentID",
        "AbsentDate",
        "SectionSeq",
        "UpdateID",
        "UpdateDate",
    );

    // public $casts = array(
    //     'StdGroupAbsentDetailID' => 'string',
    // );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // if (!$model->StdGroupAbsentDetailID) {
            //     // only set a UUID on first creation and if not already set
            //     $model->StdGroupAbsentDetailID = (string) Str::uuid();
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
