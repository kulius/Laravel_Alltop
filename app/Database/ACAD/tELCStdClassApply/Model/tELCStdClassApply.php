<?php

namespace App\Database\ACAD\tELCStdClassApply\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tELCStdClassApply extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tELCStdClassApply';

    public $timestamps = false;

    public $primaryKey = 'autoid';

    public $incrementing = true;

    public $fillable = array(
        'StudentID',
        'TWYear',
        'Season',
        'ApplyStatus',
        'Creator',
        'UpdateID',
        'UpdateDate',
        'ClassID',
        'state',
    );

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->Creator    = Session::get('user_id');
            $model->UpdateID   = Session::get('user_id');
            $model->UpdateDate = Carbon::now();
        });

        static::updating(function ($model) {
            $model->UpdateID   = Session::get('user_id');
            $model->UpdateDate = Carbon::now();
        });
    }
}
