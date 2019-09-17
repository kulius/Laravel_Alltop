<?php

namespace App\Database\ACAD\tSprRepresent\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class tSprRepresent extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tSprRepresent';

    public $timestamps = false;

    public $primaryKey   = 'RepresentID';
    // public $incrementing = false;
    // public $casts        = array(
    //     'tSprRepresent' => 'string',
    // );

    public $fillable = array(
        "RepresentNo",
        "RepresentName",
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
