<?php

namespace App\Database\ACAD\tELCClassStd\Model;

use Illuminate\Database\Eloquent\Model;

class tELCClassStd extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tELCClassStd';

    public $timestamps = false;

    public $primaryKey = 'autoid';

    public $casts = array(
        'StudentID' => 'string',
        'ClassID'   => 'string',
    );

    public $fillable = array(
        'StudentID',
        'ClassID',
        'state',
        'Memo',
    );

}
