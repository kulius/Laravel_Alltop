<?php

namespace App\Database\ACAD\tBhrStdRPData\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tBhrStdRPData extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tBhrStdRPData';

    public $timestamps = false;

    public $primaryKey = 'StdRPDataID';

    // public $incrementing = false;

    public $fillable = array(
        "StdRPMainDataID",
        "RPReasonKindID",
        "OccurDate",
        "SuggestPer",
        "Memo",
        "ApplyID",
        "ApplyDate",
        "UpdateID",
        "UpdateDate",
    );

    // public $casts = array(
    //     'StdRPDataID' => 'string',
    // );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // if (!$model->StdRPDataID) {
            //     // only set a UUID on first creation and if not already set
            //     $model->StdRPDataID = (string) Str::uuid();
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
