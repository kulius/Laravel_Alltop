<?php

namespace App\Database\ACAD\tBhrParaCopyHistory\Model;

use Illuminate\Database\Eloquent\Model;

class tBhrParaCopyHistory extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tBhrParaCopyHistory';

    public $timestamps = false;

    public $primaryKey = 'tBhrParaCopyHistoryID';

    public $incrementing = true;

    public $fillable = array(
        'SourceACADYear',
        'SourceSemester',
        'TargetACADYear',
        'TargetSemester',
        'UpdateID',
        'UpdateDate',
    );

    public $casts = array(
        'tBhrParaCopyHistoryID' => 'string',
    );

    //新增時產生GUID
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {

    //         if (!$model->tBhrParaCopyHistoryID) {
    //             // only set a UUID on first creation and if not already set
    //             $model->tBhrParaCopyHistoryID = (string) Str::uuid();
    //         }
    //     });
    // }
}
