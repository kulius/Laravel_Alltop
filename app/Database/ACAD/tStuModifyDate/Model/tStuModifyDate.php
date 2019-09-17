<?php

namespace App\Database\ACAD\tStuModifyDate\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tStuModifyDate extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tStuModifyDate';

    public $timestamps = false;

    public $primaryKey = 'ModifyDateID';

    public $fillable = array(
        'ACADYear',
        'Semester',
        'ModifyDateBeg',
        'ModifyDateEnd',
        'ColumnName',
        'ModifyDateKind',
        'StuModifyDateKind',
        'RestrictState',
        'UpdateID',
        'UpdateTime',
        'StuModifyObject',
        'ClassTypeID',
        'DayfgID',
        'EnrollType',
        'UnitID',
        'ClassID',
        'StudentID',
        'ModifyType',
    );

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->UpdateID   = Session::get('user_id');
            $model->UpdateTime = Carbon::now();
        });

        static::updating(function ($model) {
            $model->UpdateID   = Session::get('user_id');
            $model->UpdateTime = Carbon::now();
        });
    }
}
