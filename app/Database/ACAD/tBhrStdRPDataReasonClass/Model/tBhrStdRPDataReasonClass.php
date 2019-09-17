<?php

namespace App\Database\ACAD\tBhrStdRPDataReasonClass\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tBhrStdRPDataReasonClass extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tBhrStdRPDataReasonClass';

    public $timestamps = false;

    public $primaryKey = 'StdRPDataReasonClassID';

    // public $incrementing = false;

    public $fillable = array(
        "StdRPDataID",
        "StdRPDataStuID",
        "BonusPenaltyPara",
        "RPQty",
        "UpdateID",
        "UpdateDate",
    );

    // public $casts = array(
    //     'StdRPDataReasonClassID' => 'string',
    // );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // if (!$model->StdRPDataReasonClassID) {
            //     // only set a UUID on first creation and if not already set
            //     $model->StdRPDataReasonClassID = (string) Str::uuid();
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
