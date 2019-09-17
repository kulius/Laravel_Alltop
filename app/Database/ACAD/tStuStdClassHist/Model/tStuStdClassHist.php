<?php

namespace App\Database\ACAD\tStuStdClassHist\Model;

use Illuminate\Database\Eloquent\Model;

class tStuStdClassHist extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tStuStdClassHist';

    public $timestamps = false;

    public $primaryKey = 'StdClassHistID';

    // public $incrementing = false;

    public $fillable = array(
        'Year'          => '學年',
        'Semester'      => '學期',
        'StudentID'     => '學生系統ID',
        'DayfgID'       => '部別ID',
        'ClassTypeID'   => '學制ID',
        'UnitID'        => '科系所ID',
        'StudyGroupID'  => '組別ID',
        'Grade'         => '年級',
        'ClassNo'       => '班級',
        'Stdstate'      => '在學狀態',
        'ClassID'       => '班級代碼',
        'ClassState'    => '班級狀態(I=一般, E=延修)',
        'IsRegistered'  => '是否為已註冊',
        'ClassUniqueNo' => '',
    );

    public $casts = array(
        // 'StdClassHistID' => 'string',
    );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

        });
    }
}
