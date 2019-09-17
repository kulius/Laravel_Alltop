<?php

namespace App\Database\ACAD\tCampSession\Model;

use Illuminate\Database\Eloquent\Model;

class tCampSession extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tCampSession';

    public $timestamps = false;

    public $primaryKey = 'SessionNo';

    public $casts = array(
    );

    // public $incrementing = false;

    public $fillable = array(
        'SessionName',
        'SessionEngName',
        'FirstDate',
        'LastDate',
        'OpenYN',
        'TWYear',
    );
}
