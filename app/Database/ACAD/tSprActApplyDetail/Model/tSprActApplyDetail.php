<?php

namespace App\Database\ACAD\tSprActApplyDetail\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class tSprActApplyDetail extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tSprActApplyDetail';

    public $timestamps = false;

    public $primaryKey   = 'ActivityDetailID';
    // public $incrementing = false;
    // public $casts        = array(
    //     'tSprActApplyDetail' => 'string',
    // );

    public $fillable = array(
        "ActApplyID",
        "StudentID",
        "IsLeader",
        "state",
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
