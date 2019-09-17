<?php

namespace App\Database\ACAD\tCouPoorLearning\Model;

use Illuminate\Database\Eloquent\Model;

class tCouPoorLearning extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tCouPoorLearning';

    public $timestamps = false;

    public $primaryKey = 'PoorlearnID';

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
        'PoorlearnID' => 'string',
    );

    //新增時產生GUID
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {

    //         if (!$model->PoorlearnID) {
    //             // only set a UUID on first creation and if not already set
    //             $model->PoorlearnID = (string) Str::uuid();
    //         }
    //     });
    // }
}
