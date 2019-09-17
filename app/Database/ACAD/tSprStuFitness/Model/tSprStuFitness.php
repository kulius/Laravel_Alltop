<?php

namespace App\Database\ACAD\tSprStuFitness\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class tSprStuFitness extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tSprStuFitness';

    public $timestamps = false;

    public $primaryKey = 'FitnessID';
    // public $incrementing = false;
    // public $casts        = array(
    //     'FitnessID' => 'string',
    // );

    public $fillable = array(
        "StudentID",
        "Height",
        "Weight",
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
