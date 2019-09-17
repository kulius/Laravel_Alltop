<?php

namespace App\Database\ACAD\tSprActApply\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class tSprActApply extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tSprActApply';

    public $timestamps = false;

    public $primaryKey = 'ActApplyID';

    // public $incrementing = false;
    // public $casts        = array(
    //     'ActApplyID' => 'string',
    // );

    public $fillable = array(
        "ActivityDetailID",
        "IsTeamApply",
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
