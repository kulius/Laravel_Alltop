<?php

namespace App\Database\ACAD\tStuBank\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tStuBank extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tStuBank';

    public $timestamps = false;

    public $primaryKey = 'StudentID';

    public $casts = array(
    );

    public $fillable = array(
        'StudentID',
        'BankNo',
        'BankName',
        'BankAccount',
        'AccountOwner',
        'OwnerRelation',
        'UpdateID',
        'UpdateDate',
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
