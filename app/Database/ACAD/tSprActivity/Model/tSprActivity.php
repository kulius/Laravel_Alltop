<?php

namespace App\Database\ACAD\tSprActivity\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class tSprActivity extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tSprActivity';

    public $timestamps = false;

    public $primaryKey   = 'ActivityID';
    // public $incrementing = false;
    // public $casts        = array(
    //     'tSprActivity' => 'string',
    // );

    public $fillable = array(
        "ACADYear",
        "Semester",
        "ActivityName",
        "NoticeDate",
        "ActSDate",
        "ActEDate",
        "Limit",
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
