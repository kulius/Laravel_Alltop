<?php

namespace App\Database\ACAD\tBhrBehaviorClass\Repo;

use App\Database\ACAD\ACADSysvar\Model\tACADSysvar;
use Illuminate\Support\Facades\DB;

class tBhrBehaviorClassRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tBhrBehaviorClass";
        $this->Msg   = "參數代碼檔";
    }

    public static function tBhrBehaviorClassSetting($aParam = array())
    {
        //第一次載入時直接查詢當前學年度的資料
        $sYear = tACADSysvar::where(array('var' => 'stu_year'))->first()->content;

        $sACADYear_srh  = isset($aParam['sACADYear_srh']) ? $aParam['sACADYear_srh'] : $sYear;
        $sSemester_srh  = isset($aParam['sSemester_srh']) ? $aParam['sSemester_srh'] : null;
        $sDayfg_srh     = isset($aParam['sDayfgID_srh']) ? $aParam['sDayfgID_srh'] : null;
        $sClassType_srh = isset($aParam['sClassTypeID_srh']) ? $aParam['sClassTypeID_srh'] : null;

        $sWhere = ' 1 = 1 ';

        $aParam = array();

        if ($sACADYear_srh) {
            $sWhere .= " AND a.ACADYear = ? ";
            $aParam[] = $sACADYear_srh;
        }
        if ($sSemester_srh) {
            $sWhere .= " AND a.Semester = ? ";
            $aParam[] = $sSemester_srh;
        }
        if ($sDayfg_srh) {
            $sWhere .= " AND a.DayfgID = ? ";
            $aParam[] = $sDayfg_srh;
        }
        if ($sClassType_srh) {
            $sWhere .= " AND a.ClassTypeID = ? ";
            $aParam[] = $sClassType_srh;
        }

        $aField = array_keys(
            array(
                "a.BehaviorClassID"                     => "操行等級代碼",
                "a.ACADYear"                            => "學年",
                "a.Semester"                            => "學期",
                "b.DayfgName"                           => "部別",
                "c.ClassTypeName"                       => "學制",
                "CAST(a.HighClass AS int) AS HighClass" => "優等分數",
                "CAST(a.Class1 AS int) AS Class1"       => "甲等分數",
                "CAST(a.Class2 AS int) AS Class2"       => "乙等分數",
                "CAST(a.Class3 AS int) AS Class3"       => "丙等分數",
                "CAST(a.Class4 AS int) AS Class4"       => "丁等分數",
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = 'tBhrBehaviorClass';

        $sSql = "
        SELECT {$sSelect}
        FROM {$sTable} a
            LEFT JOIN tDayfg b ON a.DayfgID = b.DayfgID
            LEFT JOIN tClassType c ON a.ClassTypeID = c.ClassTypeID
        WHERE {$sWhere}
        ORDER BY a.ACADYear, a.Semester";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }
}
