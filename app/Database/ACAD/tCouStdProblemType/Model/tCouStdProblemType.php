<?php

namespace App\Database\ACAD\tCouStdProblemType\Model;

use Illuminate\Database\Eloquent\Model;

class tCouStdProblemType extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tCouStdProblemType';

    public $timestamps = false;

    public $primaryKey = 'StdProblemID';

    public $incrementing = true;

    public $fillable = array(
        'CouTutorID',
        'ProblemID',
        'ProContent',
        'ApplyID',
        'ApplyDate',
        'UpdateID',
        'UpdateDate',
    );

    public $casts = array(
        'StdProblemID' => 'string',
    );

    //新增時產生GUID
    //protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {

    //         if (!$model->StdProblemID) {
    //             // only set a UUID on first creation and if not already set
    //             $model->StdProblemID = (string) Str::uuid();
    //         }
    //     });
    // }
}
