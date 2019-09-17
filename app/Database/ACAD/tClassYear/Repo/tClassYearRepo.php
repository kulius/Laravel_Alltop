<?php

namespace App\Database\ACAD\tClassYear\Repo;

use Illuminate\Support\Facades\DB;

class tClassYearRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tClassYear";
        $this->Msg   = "年度班級";
    }

    public function YearClassData($aParam = array())
    {
        $sACADYear_srh = isset($aParam['sACADYear_srh']) ? $aParam['sACADYear_srh'] : null;
        $sSemester_srh = isset($aParam['sSemester_srh']) ? $aParam['sSemester_srh'] : null;

        $aField = array_keys(array(
            "Autoid"       => "自增值",
            "ACADYear"     => "學年度",
            "Semester"     => "學期",
            "ClassID"      => "班級ID",
            "ClassName"    => "班級名稱",
            "ClassENGName" => "班籍英文名稱",
            "ClassAlias"   => "班級簡稱",
        ));

        $sSelect = implode(", ", $aField);
        $sTable  = 'tClassYear';
        $sWhere  = ' 1 = 1 ';
        $aParams = array();
        if ($sACADYear_srh) {
            $sWhere .= " AND ACADYear = ? ";
            $aParams[] = $sACADYear_srh;
        }
        if ($sSemester_srh) {
            $sWhere .= " AND Semester = ?";
            $aParams[] = $sSemester_srh;
        }

        $sSql = "
            SELECT {$sSelect}
              FROM {$sTable}

             WHERE {$sWhere}";

        return DB::connection('ACAD')->select($sSql, $aParams);
    }
}
