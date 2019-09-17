<?php

namespace App\Database\ACAD\tStuStudentOpt\Model;

use Illuminate\Database\Eloquent\Model;

class tStuStudentOpt extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tStuStudentOpt';

    public $timestamps = false;

    public $primaryKey = 'StudentOptID';
    // public $incrementing = false;

    public $casts = array(
        // 'StudentOptID' => 'string',
    );

    public $fillable = array(
        'StudentOpt', 'StudentOptName', 'state',
        'EduCodeGroup',
    );

    public function detail()
    {
        return $this->hasMany('App\Database\ACAD\tStuStudentOptDetail\Model\tStuStudentOptDetail', 'StudentOptID', 'StudentOptID');
    }

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

        });
    }
}
