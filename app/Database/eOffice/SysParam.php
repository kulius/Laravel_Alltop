<?php

namespace App\Database\eOffice;

use Illuminate\Database\Eloquent\Model;

class SysParam extends Model
{
    public $connection = 'eOffice';

    public $table = 'tSysParam';

    public $fillable = array(
        'param_name', 'param_content',
        'param_remark', 'param_class',
    );

    public $primaryKey = 'seq';

    public $timestamps = false;

}
