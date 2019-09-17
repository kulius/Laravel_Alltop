<?php

namespace App\Database\ACAD\tSprRepresentUnit\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class tSprRepresentUnit extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tSprRepresentUnit';

    public $timestamps = false;

    public $primaryKey   = 'RepresentUnitID';
    // public $incrementing = false;
    // public $casts        = array(
    //     'tSprRepresentUnit' => 'string',
    // );

    public $fillable = array(
        "ACADYear",
        "UnitID",
        "StudentID",
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
