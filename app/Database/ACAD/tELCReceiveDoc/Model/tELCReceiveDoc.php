<?php

namespace App\Database\ACAD\tELCReceiveDoc\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class tELCReceiveDoc extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tELCReceiveDoc';

    public $timestamps = false;

    public $primaryKey = 'autoid';

    public $casts = array(
        'StudentID' => 'string',
        'RequiredDocID' => 'string',
    );

    public $incrementing = false;

    public $fillable = array(
        'StudentID',
        'RequiredDocID',
        'ReceiveState',
        'UpdateID',
        'UpdateDate',
    );
}
