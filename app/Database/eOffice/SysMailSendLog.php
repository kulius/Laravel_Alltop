<?php

namespace App\Database\eOffice;

use Illuminate\Database\Eloquent\Model;

class SysMailSendLog extends Model
{
    public $connection = 'eOffice';

    public $table = 'tSysMailSendLog';

    public $fillable = array(
        'mail_send_seq', 'mail_send_time',
    );

    public $primaryKey = 'seq';

    public $timestamps = false;
}
