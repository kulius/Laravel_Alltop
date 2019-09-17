<?php

namespace App\Database\ACAD\tELCClassStd\Repo;

use App\Alltop\BaseModel;
use Illuminate\Support\Facades\DB;

class tELCClassStdRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tELCClassStd";
        $this->Msg   = "語言班級學生";
    }

    public function getELCClassStd($aParams = array())
    {
        $aField = array_keys(array(
            "a.autoid"     => "",
            "b.*"          => "學生資料",
            "c.*"          => "班級資料",
            "d.NationName" => "國別名稱",
        ));
        //條件
        $aWhere = BaseModel::setWhere($aParams);
        // dd($aParams, $aWhere);

        $sWhere = $aWhere["where"];
        $aParam = $aWhere["param"];

        $sSelect = implode(", ", $aField);
        $sTable  = 'tELCStdClassApply';

        $sSql = "
            SELECT {$sSelect}
              FROM {$sTable} a
        RIGHT JOIN tELCStudent b ON a.StudentID = b.StudentID
              JOIN tELCClass c ON a.ClassID = c.ClassID
         LEFT JOIN tNation d ON b.NationID = d.NationID
             WHERE {$sWhere}
          ORDER BY c.ClassName";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }
}
