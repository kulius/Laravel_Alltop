<?php

namespace App\Database\eOffice;

use Illuminate\Database\Eloquent\Model;

class SysExample extends Model
{
    public $connection = 'eOffice';

    public $table = 'tSysExample';

    public $timestamps = false;

    public $fillable = array(
        'text', 'number', 'mail',
        'datetime', 'textarea', 'radio',
        'check', 'drop',
    );

    public $casts = array(
        'radio' => 'array',
        'check' => 'array',
        'drop'  => 'array',
    );

    public $primaryKey = 'seq';
}
