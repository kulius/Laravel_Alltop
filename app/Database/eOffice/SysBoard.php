<?php

namespace App\Database\eOffice;

use Illuminate\Database\Eloquent\Model;

class SysBoard extends Model
{
    public $connection = 'eOffice';

    public $table = 'tSysBoard';

    public $fillable = array(
        'board_number',
        'board_type', 'board_status',
        'board_title', 'board_content',
        'board_start_date', 'board_end_date',
        'ins_user_number', 'ins_datetime',
        'upd_user_number', 'upd_datetime',
    );

    public $primaryKey = 'seq';

    public $timestamps = false;
}
