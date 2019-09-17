<?php

namespace App\Database\ACAD\tDayfgClassTypeSemester\Model;

use Illuminate\Database\Eloquent\Model;

class tDayfgClassTypeSemester extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tDayfgClassTypeSemester';

    public $timestamps = false;

    public $primaryKey = 'AutoNo';

    public $fillable = array(
        'AutoNo',
        'Semester',
        'Calculable',
        'ClassTypeID',
        'DayfgID',
    );

}
