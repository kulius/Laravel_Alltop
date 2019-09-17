<?php

namespace App\Database\ACAD\tCusClassRoomCondition\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tCusClassRoomCondition extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tCusClassRoomCondition';

    public $timestamps = false;

    public $primaryKey = 'ClassRoomConditionID';

    public $fillable = array(
        'ACADYear', 'Semester', 'DEPNO', 'ClassRoomConditionName', 'UpdateID', 'UpdateDate',
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
