<?php

namespace App\Database\ACAD\tClassType\Model;

use Illuminate\Database\Eloquent\Model;

class tClassType extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tClassType';

    public $timestamps = false;

    public $primaryKey = 'ClassTypeID';
    // public $incrementing = false;

    public $casts = array(
        'ClassTypeID' => 'string',
        'UCANKind'    => 'string',
        'UCANKind'    => 'string',
    );

    public $fillable = array(
        'ClassType', 'ClassTypeName', 'ClassTypeENGName',
        'state', 'ClassTypeAlias', 'ClassTypeKind', 'SDCode', 'UCANCode',
        'Seq', 'IsOfficial', 'SDEduLevelCode', 'DiplomaClassTypeNo',
        'UCANKind', 'SDSpecialClass', 'UpdateID', 'UpdateDate',
        'GraduateLevelMOFCode',
    );

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->UpdateID   = Session::get('user_id');
            $model->UpdateDate = Carbon::now();
        });

        static::updating(function ($model) {
            $model->UpdateID   = Session::get('user_id');
            $model->UpdateDate = Carbon::now();
        });
    }
}
