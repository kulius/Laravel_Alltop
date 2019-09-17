<?php

namespace App\Database\eOffice;

use Illuminate\Database\Eloquent\Model;

class SysGroupGrant extends Model
{
    public $connection = 'eOffice';

    public $table = 'tSysGroupGrant';

    public $fillable = array(
        'group_number', 'menu_number',
    );

    public $primaryKey = 'seq';

    public $timestamps = false;
}
