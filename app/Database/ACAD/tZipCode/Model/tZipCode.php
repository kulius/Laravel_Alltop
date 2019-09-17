<?php

namespace App\Database\ACAD\tZipCode\Model;

use Illuminate\Database\Eloquent\Model;

class tZipCode extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tZipCode';

    public $timestamps = false;

    public $primaryKey = 'ZipID';
    // public $incrementing = false;

    public $casts = array(
    );

    public $fillable = array(
        'ZipCode',
        'Address',
        'upper',
        'state',
    );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

        });
    }
}
