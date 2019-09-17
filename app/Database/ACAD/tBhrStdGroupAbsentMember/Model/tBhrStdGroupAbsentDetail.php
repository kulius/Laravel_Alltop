<?php

namespace App\Database\ACAD\tBhrStdGroupAbsentMember\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tBhrStdGroupAbsentMember extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tBhrStdGroupAbsentMember';

    public $timestamps = false;

    public $primaryKey = 'StdGroupAbsentMemberID';

    // public $incrementing = false;

    public $fillable = array(
        "StdGroupAbsentID",
        "StudentID",
        "UpdateID",
        "UpdateDate",
    );

    // public $casts = array(
    //     'StdGroupAbsentMemberID' => 'string',
    // );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // if (!$model->StdGroupAbsentMemberID) {
            //     // only set a UUID on first creation and if not already set
            //     $model->StdGroupAbsentMemberID = (string) Str::uuid();
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
