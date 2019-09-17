<?php

namespace App\Database\ACAD\tBhrMeetingKind\Model;

use Illuminate\Database\Eloquent\Model;

class tBhrMeetingKind extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tBhrMeetingKind';

    public $timestamps = false;

    public $primaryKey = 'MeetingKindID';

    public $fillable = array(
        'MeetingKindName',
        'state',
        'UpdateID',
        'UpdateDate',
    );

    // public $casts = array(
    //     'MeetingKindID' => 'string',
    // );

    //新增時產生GUID
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         if (!$model->MeetingKind) {
    //             // only set a UUID on first creation and if not already set
    //             $model->MeetingKind = (string) Str::uuid();
    //         }
    //     });
    // }
}
