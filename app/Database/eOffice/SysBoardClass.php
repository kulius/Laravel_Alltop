<?php

namespace App\Database\eOffice;

use Illuminate\Database\Eloquent\Model;

class SysBoardClass extends Model
{
    public $connection = 'eOffice';

    public $table = 'tSysBoardClass';

    public $fillable = array(
        'board_class_name', 'board_class_status',
    );

    public $primaryKey = 'seq';

    public $timestamps = false;

}
