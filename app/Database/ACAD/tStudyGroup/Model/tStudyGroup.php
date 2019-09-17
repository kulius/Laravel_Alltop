<?php

namespace App\Database\ACAD\tStudyGroup\Model;

use Illuminate\Database\Eloquent\Model;

class tStudyGroup extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tStudyGroup';

    public $timestamps = false;

    public $primaryKey = 'StudyGroupID';

    // public $incrementing = false;

    public $casts = array(
    );

    public $fillable = array(
        'StudyGroup',
        'StudyGroupName',
        'StudyGroupENGName',
        'UnitID',
        'state',
        'StudyGroupNo',
        'StudyGroupAlias',
    );
    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

        });
    }
}
