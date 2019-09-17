<?php

namespace App\Database\ACAD\tStuInterest\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tStuInterest extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tStuInterest';

    public $timestamps = false;

    public $primaryKey = 'StuInterestID';

    public $casts = array(
    );

    public $fillable = array(
        'StudentID',
        'Interest',
        'InterestMemo',
        'Seq',
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
