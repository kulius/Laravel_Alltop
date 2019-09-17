<?php

namespace App\Database\ACAD\tMilRank\Model;

use Illuminate\Database\Eloquent\Model;

class tMilRank extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tMilRank';

    public $timestamps = false;

    public $primaryKey = 'MilRankID';

    public $casts = array(
    );

    // public $incrementing = false;

    public $fillable = array(
        'MilRankName',
        'state',
        'Seq',
        'MilRankNo',
    );

    //新增時產生GUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

        });
    }
}
