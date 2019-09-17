<?php

namespace App\Database\ACAD\tStudent\Model;

use Illuminate\Database\Eloquent\Model;

class tStudent extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tStudent';

    public $timestamps = false;

    public $primaryKey   = 'StudentID';
    public $incrementing = false;
    public $casts        = array(
        'StudentID' => 'string',
    );
    protected $guarded = array(
        'StudentID',
    );

}
