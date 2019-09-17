<?php

namespace App\Database\ACAD\tCusClassRoomConditionDetail\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tCusClassRoomConditionDetail extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tCusClassRoomConditionDetail';

    public $timestamps = false;

    public $primaryKey = 'ClassRoomConditionDetailID';

    public $fillable = array(
        'Seq', 'UpdateID', 'UpdateDate', 'ClassRoomConditionID', 'ClassRoomID',
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
