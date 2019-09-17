<?php

namespace App\Database\ACAD\tStuExam\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tStuExam extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tStuExam';

    public $timestamps = false;

    public $primaryKey = 'StuExamID';

    public $casts = array(
    );

    public $fillable = array(
        'StudentID',
        'ExamKind',
        'ExamYear',
        'ExamLevel',
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
