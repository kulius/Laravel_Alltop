<?php

namespace App\Database\ACAD\tDayfgClassType\Model;

use Illuminate\Database\Eloquent\Model;

class tDayfgClassType extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tDayfgClassType';

    public $timestamps = false;

    public $primaryKey = 'DayfgClassTypeID';

    // public $incrementing = false;

    public $casts = array(
    );

    public $fillable = array(
        'DayfgID',
        'ClassTypeID',
        'state',
        'DayfgClassType',
        'EnterHeadNo',
        'EduCodeCus',
        'EduCodeDNS',
        'EduCodeClassType',
        'DayfgClassTypeName',
        'DayfgClassTypeEngName',
        'DayfgClassTypeAlias',
    );

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

        });
    }
}
