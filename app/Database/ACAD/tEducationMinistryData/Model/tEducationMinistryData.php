<?php

namespace App\Database\ACAD\tEducationMinistryData\Model;

use Illuminate\Database\Eloquent\Model;

class tEducationMinistryData extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tEducationMinistryData';

    public $timestamps = false;

    public $primaryKey = 'DataID';

    // public $incrementing = false;

    public $fillable = array(
        'DataGroupID',
        'Name',
        'Code',
        'state',
    );

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {});
    }

}
