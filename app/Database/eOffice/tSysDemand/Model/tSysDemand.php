<?php

namespace App\Database\eOffice\tSysDemand\Model;

use Illuminate\Database\Eloquent\Model;

class tSysDemand extends Model
{
    //
    protected $connection = 'eOffice';

    public $table = 'tSysDemand';

    public $timestamps = false;

    public $primaryKey = 'ID';
    //public $incrementing = false;

    // public $casts = array(
    //     'ID' => 'string',
    // );
    //放入能修改的欄位
    public $fillable = array(
        'DemandNo'
        , 'FillTime'
        , 'FillUnit'
        , 'PNO'
        , 'Filler'
        , 'Email'
        , 'Tel'
        , 'SystemName'
        , 'FunctionName'
        , 'Kind'
        , 'RequireDescript'
        , 'DemandTime'
        , 'CompleteTime'
        , 'ProcessReply'
        , 'ProcessStatus'
        , 'ReplyStaff'
        , 'CompleteStatus'
        , 'ApplyID'
        , 'ApplyDate'
        , 'UpdateID'
        , 'UpdateDate'
        , 'DrawalStatus',
    );

//    新增時產生GUID
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {

    //         if (!$model->ID) {
    //             // only set a UUID on first creation and if not already set
    //             $model->ID = (string) Str::uuid();
    //         }
    //     });
    // }
}
