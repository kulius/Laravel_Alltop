<?php

namespace App\Database\ACAD\tClassAll\Model;

use Illuminate\Database\Eloquent\Model;

class tClassAll extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tClassAll';

    public $timestamps = false;

    public $primaryKey   = 'ClassID';
    public $incrementing = false;
    public $casts        = array(
        'ClassID' => 'string',
    );
    public $fillable = array(
        'ACADYear', 'Semester', 'ClassID', 'UnitClassTypeID', 'DIVS_ID'
        , 'ClassName', 'ClassENGName', 'ClassAlias', 'CLS_ID', 'ClassUniqueNo',
        'UnitNo',
    );

}
