<?php

namespace App\Database\UPLOAD\tITFILE\Model;

use Illuminate\Database\Eloquent\Model;

class tITFILE extends Model
{
    protected $connection = 'UPLOAD';

    public $table = 'tITFILE';

    public $timestamps = false;

    public $primaryKey = 'var';

    public $fillable = array(
        'formid', 'file_name', 'file_type',
        'file_size', 'file_encode', 'file_path',
        'ins_userid', 'ins_datetime',
    );

}
