<?php

namespace App\Database\ACAD\tStuChangeKind\Model;

use Illuminate\Database\Eloquent\Model;

class tStuChangeKind extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tStuChangeKind';

    public $timestamps = false;

    public $primaryKey = 'ChangeKind';

    public $casts = array(
    );

    public $fillable = array(
        'ChangeKind',
        'ChangeKindName',
        'state',
        'Stdstate',
    );

}
