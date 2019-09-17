<?php

namespace App\Database\eOffice;

use Illuminate\Database\Eloquent\Model;

class SysUserGrant extends Model
{
    public $connection = 'eOffice';

    public $table = 'tSysUserGrant';

    public $fillable = array(
        'user_number', 'menu_number',
    );

    public $primaryKey = 'seq';

    public $timestamps = false;
}
