<?php

namespace App\Database\ACAD\tUnitClassTypeYear\Repo;

use App\Alltop\BaseModel;
use Illuminate\Support\Facades\DB;

class tUnitClassTypeYearRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tUnitClassTypeYear";
        $this->Msg   = "年度學程";
    }

    public function getUnitClassTypeYear($aParams = array())
    {
        $aField = array_keys(array(
            "a.autoid"                                    => "自增值",
            "a.ACADYear"                                  => "學年度",
            "a.UnitClassTypeID"                           => "學程ID",
            "a.UnitClassTypeName"                         => "學程名稱",
            "a.UnitClassTypeENGName"                      => "學程英文名稱",
            "a.UnitClassTypeAlias"                        => "學程簡稱",
            "a.DegreeName"                                => "學位名稱",
            "a.DegreeENGName"                             => "學位英文名稱",
            "a.upper"                                     => "所屬學程ID",
            "a.EDUC_ID"                                   => "教育類別代碼",
            "a.EDUCTypeID"                                => "教育類別代碼",
            "a.EDUC_STDS"                                 => "師培生核定數",
            "a.EDUC_CLASS"                                => "師培生核定班級數",
            "a.EDUC_REAL_CLASS"                           => "師培生實際班級數",
            "a.EDUC_REAL_STDS"                            => "師培生實際學生數",
            "a.EDUC_FEE_STDS"                             => "師培生公費學生數",
            "a.EXTRA_STDS"                                => "外加名額",
            "b.DIVS_ID"                                   => "學程代碼",
            "b.UnitClassTypeName AS OriUnitClassTypeName" => "原學程名稱",
            "c.ClassTypeName"                             => "學制名稱",
            "d.UnitName"                                  => "系所名稱",
        ));
        // dd($aParams);
        //條件
        $aWhere = BaseModel::setWhere($aParams);
        // dd($aParams, $aWhere);

        $sWhere = $aWhere["where"];
        $aParam = $aWhere["param"];

        $sSelect = implode(", ", $aField);
        $sTable  = 'tUnitClassTypeYear';

        $sSql = "
            SELECT {$sSelect}
              FROM {$sTable} a
         LEFT JOIN tUnitClassType b ON a.UnitClassTypeID=b.UnitClassTypeID
         LEFT JOIN tClassType c ON b.ClassTypeID = c.ClassTypeID
         LEFT JOIN tUnit d ON b.UnitID = d.UnitID
         LEFT JOIN tUnit e ON d.upper = e.UnitID
             WHERE {$sWhere}
          ORDER BY autoid";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }
}
