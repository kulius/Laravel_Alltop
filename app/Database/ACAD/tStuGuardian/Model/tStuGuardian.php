<?php

namespace App\Database\ACAD\tStuGuardian\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tStuGuardian extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tStuGuardian';

    public $timestamps = false;

    public $primaryKey = 'GuardianID';

    public $casts = array(
    );

    public $fillable = array(
        'GuardianName',
        'GuardianSex',
        'GuardianEducationLevel',
        'GuardianCellPhone',
        'GuardianAddress',
        'GuardianNeb',
        'GuardianRoad',
        'GuardianVill',
        'GuardianZipCode',
        'GuardianSeq',
        'UpdateID',
        'UpdateDate',
        'GuardianCity',
        'GuardianDistrict',
        'GuardianProfessionID',
        'GuardianRelationID',
        'StudentID',
        'GuardianPhone',
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
