<?php

namespace App\Database\ACAD\tELCSeason\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class tELCSeason extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tELCSeason';

    public $timestamps = false;

    public $primaryKey = 'Season';

    public $casts = array(
        'Season' => 'string',
    );

    public $incrementing = false;

    public $fillable = array(
        'Season',
        'SeasonName',
        'SeasonEngName',
    );
}
