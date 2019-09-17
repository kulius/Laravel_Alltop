<?php

namespace App\Database\ACAD\tNation\Model;

use Illuminate\Database\Eloquent\Model;

class tNation extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tNation';

    public $timestamps = false;

    public $primaryKey = 'NationID';

    public $casts = array(
    );

    // public $incrementing = false;

    public $fillable = array(
        'NationName',
        'NationENGName',
        'state',
        'Seq',
        'NationTelCode',
    );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

        });
    }
}
