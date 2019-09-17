<?php

namespace App\Database\ACAD\ACADSysvar\Model;

use Illuminate\Database\Eloquent\Model;

class tACADSysvar extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tACADSysvar';

    public $timestamps = false;

    public $primaryKey   = 'var';
    public $incrementing = false;

    public $casts = array(
        'var' => 'string',
    );

    public $fillable = array(
        'var', 'name', 'content',
        'attrib', 'mocule', 'class',
    );

}
