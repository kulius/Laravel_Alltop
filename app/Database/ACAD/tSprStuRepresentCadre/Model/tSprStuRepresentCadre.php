<?php

namespace App\Database\ACAD\tSprStuRepresentCadre\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class tSprStuRepresentCadre extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tSprStuRepresentCadre';

    public $timestamps = false;

    public $primaryKey   = 'RepresentCadreID';
    // public $incrementing = false;
    // public $casts        = array(
    //     'tSprStuRepresentCadre' => 'string',
    // );

    public $fillable = array(
        "RepresentMemberID",
        "JobName",
        "ServeSDate",
        "ServeEDate",
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
