<?php

namespace App\Database\ACAD\tBhrPara\Model;

use Illuminate\Database\Eloquent\Model;

class tBhrPara extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tBhrPara';

    public $timestamps = false;

    public $primaryKey = 'ParaID';

    public $incrementing = true;

    public $fillable = array(
        'ACADYear',
        'Semester',
        'DayfgID',
        'ClassTypeID',
        'IsBalance',
        'NoMistakes',
        'AllPresentAdd',
        'ApplyID',
        'ApplyDate',
        'UpdateID',
        'UpdateDate',
    );

    public $casts = array(
        'ParaID' => 'string',
    );

    //新增時產生GUID
    //protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {

    //         if (!$model->ParaID) {
    //             // only set a UUID on first creation and if not already set
    //             $model->ParaID = (string) Str::uuid();
    //         }
    //     });
    // }
}
