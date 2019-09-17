<?php

namespace App\Database\ACAD\tUnitClassType\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tUnitClassType extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tUnitClassType';

    public $timestamps = false;

    public $primaryKey = 'UnitClassTypeID';
    // public $incrementing = false;

    public $casts = array(
        // 'UnitClassTypeID' => 'string',
    );

    public $fillable = array(
        'UnitID', 'DayfgID', 'ClassTypeID', 'StudyGroupID', 'MinYears', 'ExtraYears', 'state',
        'SemesterAmt', 'PassScore', 'DiplomaNo', 'DegreeName', 'DegreeENGName', 'ReissueDiplomaNo',
        'LeavingCertificateHead', 'UnitClassTypeName', 'UnitClassTypeEngName',
        'DIVS_M', 'DEPNO', 'MinSemesters', 'ExtraSemesters', 'DIV_ID', 'upper',
        'UnitClassTypeAlias', 'IsOffical', 'DIVS_ID', 'UnitClassTypeNo',
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
