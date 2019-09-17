<?php

namespace App\Database\ACAD\tEnrAdmitAmount\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tEnrAdmitAmount extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tEnrAdmitAmount';

    public $timestamps = false;

    public $primaryKey = 'AdmitAmountID';

    public $casts = array(
    );

    // public $incrementing = false;

    public $fillable = array(
        'EnrollYear',
        'Semester',
        'DayfgID',
        'ClassTypeID',
        'UnitID',
        'CollegeID',
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
        'FirstDate',
        'LastDate',
        'Memo',
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
