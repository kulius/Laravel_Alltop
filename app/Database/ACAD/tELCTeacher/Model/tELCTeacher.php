<?php

namespace App\Database\ACAD\tELCTeacher\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tELCTeacher extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tELCTeacher';

    public $timestamps = false;

    public $primaryKey = 'Emp_ID';

    public $incrementing = false;
    public $fillable     = array(
        'Emp_ID',
        'ChtName',
        'UpdateID',
        'UpdateDate',
        'FirstName',
        'MiddleName',
        'LastName',
        'PersonalID',
        'ResidentPermit',
        'Passport',
        'ResidenceAddress',
        'ResidenceZipCode',
        'MailingAddress',
        'MailingZipCode',
        'MailingPhone',
        'Email',
        'Memo',
        'BankNo',
        'BankCount',
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
