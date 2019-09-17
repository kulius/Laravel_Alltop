<?php

namespace App\Database\ACAD\tELCLevel\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class tELCLevel extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tELCLevel';

    public $timestamps = false;

    public $primaryKey = 'LevelNo';

    public $casts = array(
        'LevelNo' => 'string',
    );

    public $incrementing = false;

    public $fillable = array(
        'LevelNo',
        'LevelName',
        'LevelEngName',
        'UpdateID',
        'UpdateDate',
    );
}
