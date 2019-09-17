<?php

namespace App\Database\ACAD;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class tEnrAdmitAmount extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tEnrAdmitAmount';

    public $timestamps = false;

    public $primaryKey = 'AdmitAmountID';

    public $casts = array(
        'AdmitAmountID' => 'string',
    );

    public $incrementing = false;

    public $fillable = array(
        'EnrollYear',
        'Semester',
        'DayfgID',
        'ClassTypeID',
        'UnitID',
        'AdmitAmt',
        'AdmitClassAmt',
        'StudyGroupID',
        'EnrollTypeID',
        'UpdateDate',
        'UpdateID',
        'ApprovedAmt',
        'ExamAmt',
        'AdvanceEntryAmt',
        'EnrollAmt',
        'ReservationAmt',
        'RegistrationAmt',
        'Memo',
        'UnitClassTypeID',
    );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->AdmitAmountID) {
                // only set a UUID on first creation and if not already set
                $model->AdmitAmountID = (string) Str::uuid();
            }
        });
    }
}
