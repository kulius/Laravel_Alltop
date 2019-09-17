<?php

namespace App\Database\eOffice;

use Illuminate\Database\Eloquent\Model;

class SysMailSend extends Model
{
    public $connection = 'eOffice';

    public $table = 'tSysMailSend';

    public $fillable = array(
        'form_number',
        'mail_from_address', 'mail_form_user_name',
        'mail_to_address', 'mail_to_user_name', 'mail_to_user_number',
        'mail_reply_to', 'mail_subject',
        'mail_content', 'mail_send_status',
    );

    public $primaryKey = 'seq';

    public $timestamps = false;
}
