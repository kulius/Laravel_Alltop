<?php

namespace App\Database\ACAD\tBhrRPReasonKind\Model;

use Illuminate\Database\Eloquent\Model;

class tBhrRPReasonKind extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tBhrRPReasonKind';

    public $timestamps = false;

    public $primaryKey = 'RPReasonKindID';

    // public $incrementing = false;

    public $fillable = array(
        "RPReasonKindID",
        "BonusPenaltyPara",
        "Clause",
        "Article",
        "Item",
        "ReasonContent",
        "state",
        "ApplyID",
        "ApplyDate",
        "UpdateID",
        "UpdateDate",
    );

    // public $casts = array(
    //     'RPReasonKindID' => 'string',
    // );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // if (!$model->RPReasonKindID) {
            //     // only set a UUID on first creation and if not already set
            //     $model->RPReasonKindID = (string) Str::uuid();
            // }

            $model->ApplyID   = Session::get('user_id');
            $model->ApplyDate = Carbon::now();
        });

        static::updating(function ($model) {
            $model->UpdateID   = Session::get('user_id');
            $model->UpdateDate = Carbon::now();
        });
    }
}
