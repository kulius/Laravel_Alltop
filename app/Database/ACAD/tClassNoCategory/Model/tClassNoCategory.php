<?php

namespace App\Database\ACAD\tClassNoCategory\Model;

use Illuminate\Database\Eloquent\Model;

class tClassNoCategory extends Model
{

    protected $connection = 'ACAD';

    public $table = 'tClassNoCategory';

    public $timestamps = false;

    public $primaryKey = 'ClassNoCategoryID';

    public $fillable = array(
        'ClassNo', 'Seq',
        'state', 'ModifiedDate',
    );

}
