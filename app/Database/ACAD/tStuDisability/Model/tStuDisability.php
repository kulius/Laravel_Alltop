<?php

namespace App\Database\ACAD\tStuDisability\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tStuDisability extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tStuDisability';

    public $timestamps = false;

    public $primaryKey = 'StuDisabilityID';

    public $casts = array(
    );

    public $fillable = array(
        'StudentID',
        'DisabilityID',
        'UpdateID',
        'UpdateDate',
    );

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->UpdateID   = Session::get('user_id');
            $model->UpdateDate = Carbon::now();
        });

        static::updating(function ($model) {
            $model->UpdateID   = Session::get('user_id');
            $model->UpdateDate = Carbon::now();
        });
    }
}
