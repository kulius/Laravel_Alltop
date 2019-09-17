<?php

namespace App\Database\ACAD\tBhrScoreSet\Model;

use Illuminate\Database\Eloquent\Model;

class tBhrScoreSet extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tBhrScoreSet';

    public $timestamps = false;

    public $primaryKey = 'ScoreSetID';

    public $incrementing = true;

    public $fillable = array(
        'ACADYear',
        'Semester',
        'DayfgID',
        'ClassTypeID',
        'BhrBasisScoreGeneral',
        'BhrBasisScoreObserve',
        'TutorScoreUp',
        'TutorScoreLow',
        'TutorScoreRate',
        'DrillScoreUp',
        'DrillScoreLow',
        'DrillScoreRate',
        'ChiefScoreUp',
        'ChiefScoreLow',
        'ChiefScoreRate',
        'ComputScore',
        'ApplyID',
        'ApplyDate',
        'UpdateID',
        'UpdateDate',
    );

    public $casts = array(
        'ScoreSetID' => 'string',
    );

    //新增時產生GUID
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {

    //         if (!$model->ScoreSetID) {
    //             // only set a UUID on first creation and if not already set
    //             $model->ScoreSetID = (string) Str::uuid();
    //         }
    //     });
    // }
}
