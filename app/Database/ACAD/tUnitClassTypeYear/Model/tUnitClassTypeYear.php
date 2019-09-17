<?php

namespace App\Database\ACAD\tUnitClassTypeYear\Model;

use Illuminate\Database\Eloquent\Model;

class tUnitClassTypeYear extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tUnitClassTypeYear';

    public $timestamps = false;

    public $primaryKey = 'autoid';

    // public $incrementing = false;

    public $casts = array(
        // 'UnitClassTypeID' => 'string',
    );

    public $fillable = array(
        "autoid",
        "ACADYear",
        "UnitClassTypeID",
        "UnitClassTypeName",
        "UnitClassTypeENGName",
        "UnitClassTypeAlias",
        "DegreeName",
        "DegreeENGName",
        "upper",
        "EDUC_ID",
        "EDUCTypeID",
        "EDUC_STDS",
        "EDUC_CLASS",
        "EDUC_REAL_CLASS",
        "EDUC_REAL_STDS",
        "EDUC_FEE_STDS",
        "EXTRA_STDS",
        "DEGREE_CNAME",
        "DEGREE_ENAME",
        "DIV_ID",
        "DIVS_ID",
    );

}
