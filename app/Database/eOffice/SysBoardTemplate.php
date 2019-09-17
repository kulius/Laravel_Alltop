<?php

namespace App\Database\eOffice;

use Illuminate\Database\Eloquent\Model;

class SysBoardTemplate extends Model
{
    public $connection = 'eOffice';

    public $table = 'tSysBoardTemplate';

    public $fillable = array(
        'board_class_seq', 'board_template_status',
        'board_template_name', 'board_template_title',
        'board_template_content',
        'ins_user_number', 'ins_datetime',
        'upd_user_number', 'upd_datetime',
    );

    public $primaryKey = 'seq';

    public $timestamps = false;

}
