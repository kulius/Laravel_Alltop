<?php

namespace App\Database\ACAD\tStuChgReasonDetail\Model;

use Illuminate\Database\Eloquent\Model;

class tStuChgReasonDetail extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tStuChgReasonDetail';

    public $timestamps = false;

    public $primaryKey = 'ChgReasonDetailID';

    public $fillable = array(
        'ChgReasonDetailName',
        'state',
        'Reasontype',
        'IsOrderDropOut',
        'ChgReasonDetailID',
        'ChgReasonID',
        'ChgReasonDetailEngName',
    );

}
