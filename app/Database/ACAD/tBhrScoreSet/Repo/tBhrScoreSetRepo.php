<?php

namespace App\Database\ACAD\tBhrScoreSet\Repo;

use App\Database\ACAD\ACADSysvar\Model\tACADSysvar;
use Illuminate\Support\Facades\DB;

class tBhrScoreSetRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tBhrScoreSet";
        $this->Msg   = "參數代碼檔";
    }

    public static function tBhrScoreSetting($aParam = array())
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
                "a.ScoreSetID"           => "評分設定代碼",
                "a.ACADYear"             => "學年度",
                "a.Semester"             => "學期",
                "b.DayfgName"            => "部別",
                "c.ClassTypeName"        => "學制",
                "a.BhrBasisScoreGeneral" => "操行基本分數一般生",
                "a.BhrBasisScoreObserve" => "操行基本分數定察生",
                // "a.TutorScoreUp"         => "導師評分上限",
                // "a.TutorScoreLow"        => "導師評分下限",
                // "a.TutorScoreRate"       => "導師評分比率",
                // "a.DrillScoreUp"         => "教官評分上限",
                // "a.DrillScoreLow"        => "教官評分下限",
                // "a.DrillScoreRate"       => "教官評分比率",
                // "a.ChiefScoreUp"         => "主任評分上限",
                // "a.ChiefScoreLow"        => "主任評分下限",
                // "a.ChiefScoreRate"       => "主任評分比率",
                "a.ComputScore"          => "評分換算加扣總分",
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = 'tBhrScoreSet';

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
