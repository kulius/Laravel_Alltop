<?php

namespace App\Database\ACAD\tCouProblemType\Model;

use Illuminate\Database\Eloquent\Model;

class tCouProblemType extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tCouProblemType';

    public $timestamps = false;

    public $primaryKey = 'ProblemID';

    public $incrementing = true;

    public $fillable = array(
        'Content',
        'NeedText',
        'state',
        'ApplyID',
        'ApplyDate',
        'UpdateID',
        'UpdateDate',
    );

    public $casts = array(
        'ProblemID' => 'string',
    );

    //新增時產生GUID
    // protected static function boot()
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
