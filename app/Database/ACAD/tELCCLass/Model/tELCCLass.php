<?php

namespace App\Database\ACAD\tELCClass\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tELCClass extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tELCClass';

    public $timestamps = false;

    public $primaryKey = 'ClassID';

    public $casts = array(
        'ClassID'         => 'string',
        'CourseDateFirst' => 'datetime:Y-m-d',
        'CourseDateLast'  => 'datetime:Y-m-d',
    );

    // public $incrementing = false;

    public $fillable = array(
        'TWYear',
        'Season',
        'ClassName',
        'ClassEngName',
        'Memo',
        'CourseDateFirst',
        'CourseDateLast',
        'state',
        'UpdateID',
        'UpdateDate',
        'LevelNo',
        'AttendancePercent',
        'HomeWorkPercent',
        'ParticipationPercent',
        'FinalTestPercent',
        'QuizzesPercent',
        'Memo',
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
