<?php

namespace App\Database\ACAD\tPara\Model;

use Illuminate\Database\Eloquent\Model;

class tPara extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tPara';

    public $timestamps = false;

    public $primaryKey = 'autoid';

    public $fillable = array(
        'parano',
        'paranoname',
        'paracodeno',
        'paracodename',
        'UpdateID',
        'UpdateDate',
    );
}
