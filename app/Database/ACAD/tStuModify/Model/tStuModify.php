<?php

namespace App\Database\ACAD\tStuModify\Model;

use Illuminate\Database\Eloquent\Model;

class tStuModify extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tStuModify';

    public $timestamps = false;

    public $primaryKey = 'ModifyKind';

    public $incrementing = false;

    public $fillable = array(
        'ModifyKind',
        'ModifyName',
        'StuModifyDateKind',
    );

}
