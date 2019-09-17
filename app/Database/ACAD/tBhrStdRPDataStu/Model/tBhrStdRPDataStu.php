<?php

namespace App\Database\ACAD\tBhrStdRPDataStu\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tBhrStdRPDataStu extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tBhrStdRPDataStu';

    public $timestamps = false;

    public $primaryKey = 'StdRPDataStuID';

    // public $incrementing = false;

    public $fillable = array(
        "StdRPDataID",
        "StudentID",
        "Memo",
        "UpdateID",
        "UpdateDate",
    );

    // public $casts = array(
    //     'StdRPDataStuID' => 'string',
    // );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // if (!$model->StdRPDataStuID) {
            //     // only set a UUID on first creation and if not already set
            //     $model->StdRPDataStuID = (string) Str::uuid();
            // }

            $model->UpdateID   = Session::get('user_id');
            $model->UpdateDate = Carbon::now();
        });

        static::updating(function ($model) {
            $model->UpdateID   = Session::get('user_id');
            $model->UpdateDate = Carbon::now();
        });
    }
}
