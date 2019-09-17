<?php

namespace App\Database\ACAD\tStuStudentOptDetail\Model;

use Illuminate\Database\Eloquent\Model;

class tStuStudentOptDetail extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tStuStudentOptDetail';

    public $timestamps = false;

    public $primaryKey = 'StudentOptDetailID';
    // public $incrementing = false;

    public $casts = array(
    );

    public $fillable = array(
        'StudentOptID', 'StudentOptDetailName', 'state',
        'IsEdu', 'StudentOptDetail', 'EduCode', 'EduType', 'year',
    );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

        });
    }

    public function option()
    {
        return $this->hasMany();
    }

}
