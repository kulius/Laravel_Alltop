<?php

namespace App\Database\ACAD\tBhrRptSemStuBhrSpread\Model;

use Illuminate\Database\Eloquent\Model;

class tBhrRptSemStuBhrSpread extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tBhrRptSemStuBhrSpread';

    public $timestamps = false;

    public $primaryKey = 'tBhrRptSemStuBhrSpreadID';

    public $incrementing = true;

    public $fillable = array(
        'ACADYear',
        'Semester',
        'StudentID',
        'StudentNo',
        'ChtName',
        'DayfgID',
        'ClassTypeID',
        'CollegeID',
        'UnitID',
        'StudyGroupID',
        'Grade',
        'ClassNo',
        'ClassID',
        'AbsentRoll1',
        'AbsentRoll2',
        'AbsentRoll3',
        'AbsentRoll4',
        'AbsentRoll5',
        'AbsentRoll6',
        'AbsentRoll7',
        'AbsentRoll8',
        'AbsentRoll9',
        'AbsentRoll10',
        'AbsentRoll11',
        'AbsentRoll12',
        'AbsentRoll13',
        'NoEliminateRP1',
        'NoEliminateRP2',
        'NoEliminateRP3',
        'RP1',
        'RP2',
        'RP3',
        'RP4',
        'RP5',
        'RP6',
        'RewardAdd',
        'PunishSub',
        'AllPresentAdd',
        'AbsentSub',
        'TutorAddSub',
        'BehaviorScore',
        'BehBasisScore',
        'SetScore',
        'Probation',
        'BehaviorScoreLevel',
        'TutorDesValue',
        'UpdateID',
        'UpdateDate',
    );

    public $casts = array(
        'tBhrRptSemStuBhrSpreadID' => 'string',
        // 'SetScore'                 => 'int',
    );

    //新增時產生GUID
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         if (!$model->tBhrRptSemStuBhrSpreadID) {
    //             // only set a UUID on first creation and if not already set
    //             $model->tBhrRptSemStuBhrSpreadID = (string) Str::uuid();
    //         }
    //     });
    // }
}
