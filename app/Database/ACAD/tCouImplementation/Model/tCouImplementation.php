<?php

namespace App\Database\ACAD\tCouImplementation\Model;

use Illuminate\Database\Eloquent\Model;

class tCouImplementation extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tCouImplementation';

    public $timestamps = false;

    public $primaryKey = 'ImpID';

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
        'ImpID' => 'string',
    );

    //新增時產生GUID
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {

    //         if (!$model->ImpID) {
    //             // only set a UUID on first creation and if not already set
    //             $model->ImpID = (string) Str::uuid();
    //         }
    //     });
    // }
}
