<?php

namespace App\Database\ACAD\tCouAbnormalLifeAlertUnit\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tCouAbnormalLifeAlertUnit extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tCouAbnormalLifeAlertUnit';

    public $timestamps = false;

    public $primaryKey = 'AbnormalLifeAlertUnitID';

    // public $incrementing = false;

    public $fillable = array(
        "AbnormalLifeID",
        "AlertUnitPara",
        "AlertDate",
        "UpdateID",
        "UpdateDate",
    );

    // public $casts = array(
    //     'AbnormalLifeAlertUnitID' => 'string',
    // );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // if (!$model->AbnormalLifeAlertUnitID) {
            //     // only set a UUID on first creation and if not already set
            //     $model->AbnormalLifeAlertUnitID = (string) Str::uuid();
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
