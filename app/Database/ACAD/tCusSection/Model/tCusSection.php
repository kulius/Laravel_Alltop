<?php

namespace App\Database\ACAD\tCusSection\Model;

use Illuminate\Database\Eloquent\Model;

class tCusSection extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tCusSection';

    public $timestamps = false;

    public $primaryKey   = 'SectionSeq';
    public $incrementing = false;
    public $casts        = array(
        'SectionSeq' => 'string',
    );
    public $fillable = array(
        'SectionSeq', 'SectionName', 'Seq',
    );

}
