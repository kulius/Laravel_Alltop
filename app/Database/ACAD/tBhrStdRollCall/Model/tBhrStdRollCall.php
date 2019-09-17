<?php
namespace App\Database\ACAD\tBhrStdRollCall\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class tBhrStdRollCall extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tBhrStdRollCall';

    public $timestamps = false;

    public $primaryKey   = 'StdRollCallID';
    public $incrementing = false;
    public $casts        = array(
        'StdRollCallID' => 'string',
    );

    public $fillable = array(
        "RollCallEventID",
        "ACADYear",
        "Semester",
        "StudentID",
        "RollCallKindID",
        "MeetingKindID",
        "RollCallDate",
        "SectionSeq",
        "UpdateID",
        "UpdateDate",
    );
    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->StdRollCallID) {
                // only set a UUID on first creation and if not already set
                $model->StdRollCallID = (string) Str::uuid();
            }
        });
    }
}
