<?php

namespace App\Database\ACAD\tCampInformationStd\Model;

use Illuminate\Database\Eloquent\Model;

class tCampInformationStd extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tCampInformationStd';

    public $timestamps = false;

    public $primaryKey = 'autoid';

    public $casts = array(
    );

    // public $incrementing = false;

    public $fillable = array(
        'StudentID',
        'SourceNo',
        'Information',
    );
}
