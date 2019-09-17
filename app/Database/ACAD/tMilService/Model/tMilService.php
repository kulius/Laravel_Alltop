<?php

namespace App\Database\ACAD\tMilService\Model;

use Illuminate\Database\Eloquent\Model;

class tMilService extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tMilService';

    public $timestamps = false;

    public $primaryKey = 'MilServiceID';

    public $fillable = array(
        'MilServiceName', 'state',
        'Seq', 'MilServiceNo',
    );
}
