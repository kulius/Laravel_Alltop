<?php

namespace App\Database\eOffice;

use Illuminate\Database\Eloquent\Model;

class SysGroupUser extends Model
{
    public $connection = 'eOffice';

    public $table = 'tSysGroupUser';

    public $fillable = array(
        'group_number', 'user_number',
    );

    public $primaryKey = 'seq';

    public $timestamps = false;
}
