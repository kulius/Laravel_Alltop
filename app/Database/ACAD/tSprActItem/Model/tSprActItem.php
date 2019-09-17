<?php

namespace App\Database\ACAD\tSprActItem\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class tSprActItem extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tSprActItem';

    public $timestamps = false;

    public $primaryKey = 'ActItemID';
    // public $incrementing = false;
    // public $casts        = array(
    //     'tSprActItem' => 'string',
    // );

    public $fillable = array(
        "ActItemNo",
        "ActItemName",
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
