<?php

namespace App\Database\ACAD\tCouImplementation\Repo;

use App\Database\ACAD\ACADSysvar\Model\tACADSysvar;
use Illuminate\Support\Facades\DB;

class tCouImplementationRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tCouImplementation";
        $this->Msg   = "輔導實施方式參數檔";
    }

    public static function tBhrParaSetting($aParam = array())
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
                "a.ParaID"        => "參數代碼ID",
                "a.ACADYear"      => "學年度",
                "a.Semester"      => "學期",
                "b.DayfgName"     => "部別",
                "c.ClassTypeName" => "學制",
                "a.IsBalance"     => "是否獎過相抵",
                "a.NoMistakes"    => "未懲戒加分",
                "a.AllPresentAdd" => "全勤加分",
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = 'tBhrPara';

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
