<?php

namespace App\Database\ACAD\tEnrEnrollType\Model;

use Illuminate\Database\Eloquent\Model;

class tEnrEnrollType extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tEnrEnrollType';

    public $timestamps = false;

    public $primaryKey = 'EnrollTypeID';

    public $casts = array(
    );

    // public $incrementing = false;

    public $fillable = array(
        'EnrollTypeNo', 'EnrollTypeName',
        'EnrollTypeAlias', 'state',
    );

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

        });
    }
}
