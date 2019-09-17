<?php

namespace App\Database\ACAD\tDayfg\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tDayfg extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tDayfg';

    public $timestamps = false;

    public $primaryKey = 'DayfgID';

    public $casts = array(
        // 'DayfgID' => 'string',
    );

    // public $incrementing = false;

    public $fillable = array(
        'Dayfg',
        'DayfgName',
        'DayfgENGName',
        'state',
        'DayfgAlias',
        'DayfgCus',
        'DiplomaDayfgNo',
        'DayNightLevel',
        'DiplomaDayfgNo',
        'Seq',
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
