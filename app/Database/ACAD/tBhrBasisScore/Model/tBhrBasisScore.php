<?php

namespace App\Database\ACAD\tBhrBasisScore\Model;

use Illuminate\Database\Eloquent\Model;

class tBhrBasisScore extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tBhrBasisScore';

    public $timestamps = false;

    public $primaryKey = 'BasisScoreID';

    public $incrementing = true;

    public $fillable = array(
        'ACADYear',
        'Semester',
        'DayfgID',
        'ClassTypeID',
        'Grade',
        'BehBasisScore',
        'AllPresent',
        'StudentNum',
        'BehNum',
        'ApplyID',
        'ApplyDate',
    );

    public $casts = array(
        'BasisScoreID' => 'string',
    );

    //新增時產生GUID
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {

    //         if (!$model->BasisScoreID) {
    //             // only set a UUID on first creation and if not already set
    //             $model->BasisScoreID = (string) Str::uuid();
    //         }
    //     });
    // }
}
