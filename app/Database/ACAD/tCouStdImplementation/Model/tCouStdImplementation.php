<?php

namespace App\Database\ACAD\tCouStdImplementation\Model;

use Illuminate\Database\Eloquent\Model;

class tCouStdImplementation extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tCouStdImplementation';

    public $timestamps = false;

    public $primaryKey = 'StdImpID';

    public $incrementing = true;

    public $fillable = array(
        'CouTutorID',
        'ImpID',
        'ImpContent',
        'ApplyID',
        'ApplyDate',
        'UpdateID',
        'UpdateDate',
    );

    public $casts = array(
        'StdImpID' => 'string',
    );

    //新增時產生GUID
    //protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {

    //         if (!$model->StdImpID) {
    //             // only set a UUID on first creation and if not already set
    //             $model->StdImpID = (string) Str::uuid();
    //         }
    //     });
    // }
}
