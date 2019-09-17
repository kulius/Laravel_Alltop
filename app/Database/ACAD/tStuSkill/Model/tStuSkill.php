<?php

namespace App\Database\ACAD\tStuSkill\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tStuSkill extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tStuSkill';

    public $timestamps = false;

    public $primaryKey = 'StuSkillID';

    public $casts = array(
    );

    public $fillable = array(
        'StudentID',
        'Skill',
        'SkillMemo',
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
