<?php

namespace App\Database\ACAD\tBhrScoreAddSub\Model;

use Illuminate\Database\Eloquent\Model;

class tBhrScoreAddSub extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tBhrScoreAddSub';

    public $timestamps = false;

    public $primaryKey = 'ScoreAddSubID';

    public $incrementing = true;

    public $fillable = array(
        'ACADYear',
        'Semester',
        'DayfgID',
        'ClassTypeID',
        'GreatMeritAdd',
        'LittleMeritAdd',
        'PraiseMeritAdd',
        'MajorDemeritSub',
        'LittleDemeritSub',
        'RebuteDemeritSub',
        'ApplyID',
        'ApplyDate',
        'UpdateID',
        'UpdateDate',
    );

    public $casts = array(
        'ScoreAddSubID' => 'string',
    );

    //新增時產生GUID
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {

    //         if (!$model->ScoreAddSubID) {
    //             // only set a UUID on first creation and if not already set
    //             $model->ScoreAddSubID = (string) Str::uuid();
    //         }
    //     });
    // }
}
