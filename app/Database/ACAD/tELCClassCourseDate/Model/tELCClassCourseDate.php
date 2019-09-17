<?php

namespace App\Database\ACAD\tELCClassCourseDate\Model;

use Illuminate\Database\Eloquent\Model;

class tELCClassCourseDate extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tELCClassCourseDate';

    public $timestamps = false;

    public $primaryKey = 'ClassCourseID';

    public $casts = array(
    );

    // public $incrementing = false;

    public $fillable = array(
        'AutoNo',
        'ClassCourseID',
        'DayKind',
        'SectionSeq',
        'UpdateID',
        'UpdateDate',
    );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

        });
    }
}
