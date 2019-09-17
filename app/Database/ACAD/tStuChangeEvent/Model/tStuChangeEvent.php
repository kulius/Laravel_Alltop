<?php

namespace App\Database\ACAD\tStuChangeEvent\Model;

use Illuminate\Database\Eloquent\Model;

class tStuChangeEvent extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tStuChangeEvent';

    public $timestamps = false;

    public $primaryKey = 'StudentID';

    public $casts = array(
    );

    public $fillable = array(
        'ACADYear',
        'Semester',
        'ExChgSection',
        'ExChgNationName',
        'ExChgSchoolName',
        'ExChgState',
        'Memo',
        'StudentID',
        'ACADYearBack',
        'SemesterBack',
        'StartYear',
        'StartMonth',
        'EndYear',
        'EndMonth',
        'ExChgSchoolENGName',
        'ExChgUnitName',
        'ExChgUnitENGName',
    );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

        });
    }
}
