<?php

namespace App\Database\ACAD\tUnitYear\Model;

use Illuminate\Database\Eloquent\Model;

class tUnitYear extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tUnitYear';

    public $timestamps = false;

    public $primaryKey = 'UnitID';
    // public $incrementing = false;

    public $fillable = array(
        'ACADYear', 'UnitName', 'UnitENGName', 'UnitAlias', 'UnitID',
        'upper',
    );

    public $casts = array(
    );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

        });
    }
}
