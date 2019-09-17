<?php

namespace App\Database\ACAD\tTEEDUCType\Model;

use Illuminate\Database\Eloquent\Model;

class tTEEDUCType extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tTEEDUCType';

    public $timestamps = false;

    public $primaryKey = 'EDUCTypeID';

    public $incrementing = false;

    public $casts = array(
    );

    public $fillable = array(
        'EDUCTypeID', 'EDUC_ID', 'EDUCTypeName', 'EDUCTypeAlias', 'EDUC_M', 'Memo',
    );
}
