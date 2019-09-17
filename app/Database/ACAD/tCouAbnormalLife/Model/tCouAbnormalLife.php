<?php

namespace App\Database\ACAD\tCouAbnormalLife\Model;

use App\Database\ACAD\tCouAbnormalLife\Model\tCouAbnormalLife;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tCouAbnormalLife extends Model
{
    // use Rememberable;

    // public $rememberCacheTag = 'quote_queries';

    protected $connection = 'ACAD';

    public $table = 'tCouAbnormalLife';

    public $timestamps = false;

    public $primaryKey = 'AbnormalLifeID';

    // public $incrementing = false;

    public $fillable = array(
        "ACADYear",
        "Semester",
        "ProblemID",
        "StudentID",
        "DescriptionMemo",
        "ImpID",
        "TrackID",
        "TutorMemo",
        "ApplyID",
        "ApplyDate",
        "UpdateID",
        "UpdateDate",
    );

    // public $casts = array(
    //     'AbnormalLifeID' => 'string',
    // );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // if (!$model->AbnormalLifeID) {
            //     // only set a UUID on first creation and if not already set
            //     $model->AbnormalLifeID = (string) Str::uuid();
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
