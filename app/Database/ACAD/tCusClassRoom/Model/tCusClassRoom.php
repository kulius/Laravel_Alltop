<?php

namespace App\Database\ACAD\tCusClassRoom\Model;

use Illuminate\Database\Eloquent\Model;

class tCusClassRoom extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tCusClassRoom';

    public $timestamps = false;

    public $primaryKey = 'ClassRoomID';

    public $fillable = array(
        'ClassRoom', 'Capacity', 'IsAutoArrange', 'IsTeach', 'ClassRoomName', 'IsComputer',
        'BuildingID', 'IsLend', 'ManageType', 'IsInteraction', 'Manager',
    );

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

        });
    }
}
