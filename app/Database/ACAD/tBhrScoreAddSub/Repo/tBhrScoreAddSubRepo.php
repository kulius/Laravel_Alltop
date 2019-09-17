<?php

namespace App\Database\ACAD\tBhrScoreAddSub\Repo;

use App\Database\ACAD\ACADSysvar\Model\tACADSysvar;
use Illuminate\Support\Facades\DB;

class tBhrScoreAddSubRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tBhrScoreAddSub";
        $this->Msg   = "參數代碼檔";
    }

    public static function tBhrScoreAddSubSetting($aParam = array())
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
                "a.ScoreAddSubID"    => "評分設定代碼",
                "a.ACADYear"         => "學年度",
                "a.Semester"         => "學期",
                "b.DayfgName"        => "部別",
                "c.ClassTypeName"    => "學制",
                "a.GreatMeritAdd"    => "大功一次加分",
                "a.LittleMeritAdd"   => "小功一次加分",
                "a.PraiseMeritAdd"   => "嘉獎一次加分",
                "a.MajorDemeritSub"  => "大過一次扣分",
                "a.LittleDemeritSub" => "小過一次扣分",
                "a.RebuteDemeritSub" => "申誡一次扣分",
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = 'tBhrScoreAddSub';

        $sSql = "
        SELECT {$sSelect}
        FROM {$sTable} a
            LEFT JOIN tDayfg b ON a.DayfgID = b.DayfgID
            LEFT JOIN tClassType c ON a.ClassTypeID = c.ClassTypeID
        WHERE {$sWhere}
        ORDER BY a.ACADYear, a.Semester";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    public static function UpdateScoreAddSub($ACADYear, $Semester, $StudentID = null)
    {
        $sql = "
        --完整性確認
         EXEC usp_tBhrScoreIntegrityCheck '$ACADYear', '$Semester', '$StudentID'
         --獎懲重算
         EXEC usp_UpdateTBhrScoreRPCount '$ACADYear', '$Semester', '$StudentID'
         --其他規則計算
         EXEC usp_UpdateTBhrScoreOthers '$ACADYear', '$Semester', '$StudentID'
        ";

        return DB::connection('ACAD')->select($sql);
    }
}
