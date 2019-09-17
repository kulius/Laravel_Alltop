<?php

namespace App\Database\ACAD\tBhrRptAbsentList\Model;

use Illuminate\Database\Eloquent\Model;

class tBhrRptAbsentList extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tBhrRptAbsentList';

    public $timestamps = false;

    public $primaryKey = 'RptAbsentList';

    public $incrementing = true;

    public $fillable = array(
        'ACADYear',
        'Semester',
        'StudentID',
        'RollCallDate',
        'SectionSeq',
        'kName',
        'RollCallKindID',
        'LeaveKindID',
        'IsAbsent',
        'DayfgID',
        'ClassTypeID',
        'UnitID',
        'Grade',
        'ClassNo',
        'ChtName',
        'StudentNo',
        'UpdateID',
        'UpdateDate',
        'ClassID',
        'StudyGroupID',
        'RollCallEventKind',
        'AbsentItemID',
        'RollCallTeaID',
        'CreateDate',
        'SemesterCourseID',
        'week',
        'DayKind',
        'LeaveReason',
        'status',
    );

    public $casts = array(
        'RptAbsentList' => 'string',
    );

    //新增時產生GUID
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         if (!$model->RptAbsentList) {
    //             // only set a UUID on first creation and if not already set
    //             $model->RptAbsentList = (string) Str::uuid();
    //         }
    //     });
    // }
}
