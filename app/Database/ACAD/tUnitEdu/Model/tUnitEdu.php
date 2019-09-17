<?php

namespace App\Database\ACAD\tUnitEdu\Model;

use Illuminate\Database\Eloquent\Model;

class tUnitEdu extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tUnitEdu';

    public $timestamps = false;

    public $primaryKey = 'UnitID';

    public $incrementing = false;

    public $casts = array(
    );

    public $fillable = array(
        'UnitID', 'UnitName', 'state', 'UnitTypeID',
    );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

        });
    }
}
