<?php

namespace App\Database\ACAD\tClassYear\Model;

use Illuminate\Database\Eloquent\Model;

class tClassYear extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tClassYear';

    public $timestamps = false;

    public $primaryKey = 'Autoid';

    public $fillable = array(
        'ACADYear', 'Semester', 'ClassID', 'UnitClassTypeID', 'DIVS_ID'
        , 'ClassName', 'ClassENGName', 'ClassAlias', 'CLS_ID', 'ClassUniqueNo',
        'UnitNo',
    );
}
