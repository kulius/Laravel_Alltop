<?php

namespace App\Database\ACAD\tCouFollowTrack\Model;

use Illuminate\Database\Eloquent\Model;

class tCouFollowTrack extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tCouFollowTrack';

    public $timestamps = false;

    public $primaryKey = 'TrackID';

    public $incrementing = true;

    public $fillable = array(
        'Content',
        'NeedText',
        'TextReason',
        'state',
        'ApplyID',
        'ApplyDate',
        'UpdateID',
        'UpdateDate',
    );

    public $casts = array(
        'ParaID' => 'string',
    );

    //新增時產生GUID
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {

    //         if (!$model->TrackID) {
    //             // only set a UUID on first creation and if not already set
    //             $model->TrackID = (string) Str::uuid();
    //         }
    //     });
    // }
}
