<?php

namespace App\Database\ACAD\tUnit\Model;

use Illuminate\Database\Eloquent\Model;

class tUnit extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tUnit';

    public $timestamps = false;

    public $primaryKey = 'UnitID';
    // public $incrementing = false;

    public $casts = array(
    );

    public $fillable = array(
        'UnitName', 'UnitENGName', 'state', 'EduCode', 'UnitAlias',
        'UnitNo', 'UnitCode', 'upper', 'IsCus', 'IsDeduct', 'DEPNO',
        'UCANKind', 'UCANCode', 'IsOfficial', 'SDCode', 'SDName', 'memo',
    );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

        });
    }
}
