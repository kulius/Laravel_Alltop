<?php

namespace App\Database\ACAD\tGraduateLevel\Model;

use Illuminate\Database\Eloquent\Model;

class tGraduateLevel extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tGraduateLevel';

    public $timestamps = false;

    public $primaryKey = 'GraduateLevelID';
    // public $incrementing = false;
    public $casts = array(
    );

    public $fillable = array(
        'GraduateLevelName',
        'state',
    );

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

        });
    }
}
