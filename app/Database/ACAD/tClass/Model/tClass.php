<?php

namespace App\Database\ACAD\tClass\Model;

use Illuminate\Database\Eloquent\Model;

class tClass extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tClass';

    public $timestamps = false;

    public $primaryKey = 'ClassID';
    // public $incrementing = false;
    public $casts = array(
    );
    public $fillable = array(
        'DayfgID', 'ClassTypeID', 'UnitID', 'StudyGroupID', 'ClassSeq', 'ClassName',
        'ClassAlias', 'ClassENGName', 'state', 'Grade', 'ClassNo', 'ClassUniqueNo', 'DIVS_ID'
        , 'UnitClassTypeID', 'UnitNo',
    );

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

        });
    }

}
