<?php

namespace App\Database\ACAD\tEnrEnrollType\Repo;

use Illuminate\Support\Facades\DB;

class tEnrEnrollTypeRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tEnrEnrollType";
        $this->Msg   = "入學管道";
    }

    public function read()
    {
        $aField = array_keys(array(
            "EnrollTypeID"    => "入學管道ID",
            "EnrollTypeNo"    => "入學管道代碼",
            "EnrollTypeName"  => "入學管道名稱",
            "EnrollTypeAlias" => "入學管道簡稱",
            "state"           => "狀態",
        ));

        //條件
        $sWhere = ' 1 = 1 ';

        $sSelect = implode(", ", $aField);
        $sTable  = 'tEnrEnrollType';

        $sSql = "
            SELECT {$sSelect}
              FROM {$sTable}
             WHERE {$sWhere}
          ORDER BY EnrollTypeNo";

        return DB::connection('ACAD')->select($sSql);
    }

}
