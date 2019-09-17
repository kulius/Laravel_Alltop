<?php

namespace App\Database\ACAD\tStuOrientation\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tStuOrientation extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tStuOrientation';

    public $timestamps = false;

    public $primaryKey = 'StuOrientationID';

    public $casts = array(
    );

    public $fillable = array(
        'StudentID',
        'Orientation',
        'SubjectName',
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
