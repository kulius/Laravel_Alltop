<?php

namespace App\Database\ACAD\tCouStdFollowTrack\Model;

use Illuminate\Database\Eloquent\Model;

class tCouStdFollowTrack extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tCouStdFollowTrack';

    public $timestamps = false;

    public $primaryKey = 'StdTrackID';

    public $incrementing = true;

    public $fillable = array(
        'CouTutorID',
        'TrackID',
        'TrackContent',
        'ApplyID',
        'ApplyDate',
        'UpdateID',
        'UpdateDate',
    );

    public $casts = array(
        'StdTrackID' => 'string',
    );

    //新增時產生GUID
    //protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {

    //         if (!$model->StdTrackID) {
    //             // only set a UUID on first creation and if not already set
    //             $model->StdTrackID = (string) Str::uuid();
    //         }
    //     });
    // }
}
