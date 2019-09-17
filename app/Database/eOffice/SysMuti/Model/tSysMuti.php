<?php

namespace App\Database\eOffice\SysMuti\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class tSysMuti extends Model
{
    public $connection = 'eOffice';

    public $table = 'tSysMuti';

    public $timestamps = false;

    public $incrementing = false;

    public $fillable = array(
        'text',
        'textarea',
        'number',
        'ApplyID',
        'ApplyDate',
        'UpdateID',
        'UpdateDate',
    );

    public $casts = array(
        'MutiID' => 'string',
    );

    public $primaryKey = 'MutiID';

    //新增時產生UUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->MutiID) {
                // only set a UUID on first creation and if not already set
                $model->MutiID = (string) Str::uuid();
            }
        });
    }
}
