<?php

namespace App\Database\ACAD\tBhrBehaviorClass\Model;

use Illuminate\Database\Eloquent\Model;

class tBhrBehaviorClass extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tBhrBehaviorClass';

    public $timestamps = false;

    public $primaryKey = 'BehaviorClassID';

    public $incrementing = true;

    public $fillable = array(
        'ACADYear',
        'Semester',
        'DayfgID',
        'ClassTypeID',
        'HighClass',
        'Class1',
        'Class2',
        'Class3',
        'Class4',
        'UpdateID',
        'UpdateDate',
        'ApplyID',
        'ApplyDate',
    );

    public $casts = array(
        'BehaviorClassID' => 'string',
    );

    //新增時產生GUID
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {

    //         if (!$model->BehaviorClassID) {
    //             // only set a UUID on first creation and if not already set
    //             $model->BehaviorClassID = (string) Str::uuid();
    //         }
    //     });
    // }
}
