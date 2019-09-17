<?php

namespace App\Database\ACAD\tStuChgReason\Model;

use Illuminate\Database\Eloquent\Model;

class tStuChgReason extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tStuChgReason';

    public $timestamps = false;

    public $primaryKey = 'ChgReasonID';

    public $casts = array(
    );

    public $fillable = array(
        'ChgReasonName',
        'ChangeKind',
        'state',
        'IsEdu',
        'seq',
        'Reasontype',
        'ChgReasonEngName',
    );

}
