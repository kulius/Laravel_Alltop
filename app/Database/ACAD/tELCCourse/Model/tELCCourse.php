<?php

namespace App\Database\ACAD\tELCCourse\Model;

use Illuminate\Database\Eloquent\Model;

class tELCCourse extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tELCCourse';

    public $timestamps = false;

    public $primaryKey = 'CourseID';

    public $casts = array(
    );

    // public $incrementing = false;

    public $fillable = array(
        'CourseNo',
        'CourseName',
        'CourseEngName',
        'UpdateID',
        'UpdateDate',
    );

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

        });
    }
}
