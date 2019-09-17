<?php
namespace App\Database\ACAD\tBhrAbsentAlertLog\Model;

use Illuminate\Database\Eloquent\Model;

class tBhrAbsentAlertLog extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tBhrAbsentAlertLog';

    public $timestamps = false;

    public $primaryKey   = 'AbsentAlertLogID';
    public $incrementing = false;
    public $casts        = array(
        'AbsentAlertLogID' => 'string',
    );

    public $fillable = array(
        'ACADYear',
        'Semester',
        'StudentID',
        'AbsentAllHours',
        'AlertKind',
        'AlertID',
        'AlertDate',
    );

}
