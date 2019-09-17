<?php

namespace App\Database\ACAD\tELCRequiredDoc\Model;

use Illuminate\Database\Eloquent\Model;

class tELCRequiredDoc extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tELCRequiredDoc';

    public $timestamps = false;

    public $primaryKey = 'RequiredDocID';

    public $casts = array(
    );

    // public $incrementing = false;

    public $fillable = array(
        'RequiredDocNo',
        'StdStateELC',
        'RequiredDocName',
        'RequiredDocEngName',
        'state',
    );
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

        });
    }
}
