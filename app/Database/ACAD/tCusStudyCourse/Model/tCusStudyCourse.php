<?php

namespace App\Database\ACAD\tCusStudyCourse\Model;

use Illuminate\Database\Eloquent\Model;

class tCusStudyCourse extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tCusStudyCourse';

    public $timestamps = false;

    public $primaryKey = 'StudyCourseID';

    public $casts = array(
        'StudyCourseID' => 'string',
    );

    public $incrementing = false;

    public $fillable = array(
        'ACADYear',
        'DayfgID',
        'ClassTypeID',
        'UnitID',
        'StudyKind',
        'Memo',
        'GradCreditAmt',
        'RightContent',
        'ElasticityCredit',
        'StudyCourseName',
        'StudyCourseAlias',
        'DIVS_ID',
        'StudyClassID',
        'StudyGroupID',
        'UnitClassTypeID',
    );
}
