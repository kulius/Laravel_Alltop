<?php

namespace App\Database\eOffice\SysMutiDetail\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class tSysMutiDetail extends Model
{
    public $connection = 'eOffice';

    public $table = 'tSysMutiDetail';

    public $timestamps = false;

    public $incrementing = false;

    public $fillable = array(
        'MutiID',
        'text',
        'textarea',
        'ApplyID',
        'ApplyDate',
        'UpdateID',
        'UpdateDate',
    );

    public $casts = array(
        'DetailID' => 'string',
        'MutiID'   => 'string',
    );

    public $primaryKey = 'DetailID';

    //新增時產生UUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->DetailID) {
                // only set a UUID on first creation and if not already set
                $model->DetailID = (string) Str::uuid();
            }
        });
    }
}
