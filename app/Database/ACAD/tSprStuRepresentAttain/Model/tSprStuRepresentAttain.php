<?php

namespace App\Database\ACAD\tSprStuRepresentAttain\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class tSprStuRepresentAttain extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tSprStuRepresentAttain';

    public $timestamps = false;

    public $primaryKey   = 'RepresentAttainID';
    // public $incrementing = false;
    // public $casts        = array(
    //     'tSprStuRepresentAttain' => 'string',
    // );

    public $fillable = array(
        "RepresentMemberID",
        "CompatitionName",
        "AttainScore",
        "ApplyID",
        "ApplyDate",
        "UpdateID",
        "UpdateDate",
    );
    
    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // if (!$model->AbnormalLifeID) {
            // // only set a UUID on first creation and if not already set
            // $model->AbnormalLifeID = (string) Str::uuid();
            // }

            $model->ApplyID   = Session::get('user_id');
            $model->ApplyDate = Carbon::now();
        });

        static::updating(function ($model) {
            $model->UpdateID   = Session::get('user_id');
            $model->UpdateDate = Carbon::now();
        });
    }

}
