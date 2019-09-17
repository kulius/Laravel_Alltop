<?php

namespace App\Database\ACAD\tELCQuest\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tELCQuest extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tELCQuest';

    public $timestamps = false;

    public $primaryKey = 'QuestID';

    public $incrementing = true;

    public $fillable = array(
        'TWYear',
        'FirstQuestion',
        'SecQuestion',
    );

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->UpdateID   = Session::get('user_id');
            $model->UpdateDate = Carbon::now();
        });

        static::updating(function ($model) {
            $model->UpdateID   = Session::get('user_id');
            $model->UpdateDate = Carbon::now();
        });
    }

}
