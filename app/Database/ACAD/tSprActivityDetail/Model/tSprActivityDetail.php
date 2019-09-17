<?php

namespace App\Database\ACAD\tSprActivityDetail\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class tSprActivityDetail extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tSprActivityDetail';

    public $timestamps = false;

    public $primaryKey   = 'ActivityDetailID';
    // public $incrementing = false;
    // public $casts        = array(
    //     'tSprActivityDetail' => 'string',
    // );

    public $fillable = array(
        "ActivityID",
        "ActItemID",
        "ActGroupPara",
        "ActSexLimitPara",
        "ActApplyTypePara",
        "ActApplyPerTypePara",
        "TeamLimit",
        "ActDate",
        "NoticeDate",
        "ApplySDate",
        "ApplyEDate",
        "ActDescription",
        "ApplyID",
        "ApplyDate",
        "UpdateID",
        "UpdateDate",
    );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // if (!$model->AbnormalLifeID) {
            // // only set a UUID on first creation and if not already set
            // $model->AbnormalLifeID = (string) Str::uuid();
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
