<?php

namespace App\Database\ACAD\tEducationMinistryDataGroup\Model;

use Illuminate\Database\Eloquent\Model;

class tEducationMinistryDataGroup extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tEducationMinistryDataGroup';

    public $timestamps = false;

    public $primaryKey = 'DataGroupID';

    // public $incrementing = false;

    public $casts = array(
    );

    public $fillable = array(
        'EducationDepartment',
        'GroupName',
        'GroupCode',
        'GroupState',
    );

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

        });
    }
}
