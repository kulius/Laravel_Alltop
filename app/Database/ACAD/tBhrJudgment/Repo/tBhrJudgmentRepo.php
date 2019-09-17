<?php
namespace App\Database\ACAD\tBhrJudgment\Repo;

use App\Alltop\BaseModel;
use Illuminate\Support\Facades\DB;

class tBhrJudgmentRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tBhrJudgment";
        $this->Msg   = "操行評語";
    }

    public static function KindandID($aParam = array())
    {
        $aField = array_keys(
            array(
                "JudgmentKindName" => "操行評語分類名稱",
                "JudgmentKindID"   => "操行評語分類ID",
            )
        );
        $sSelect = implode(", ", $aField);
        $sTable  = 'tBhrJudgmentKind';

        $sSql = "
        SELECT {$sSelect}
        FROM {$sTable} ";

        return DB::connection('ACAD')->select($sSql);
    }

    // public static function NUMofData($aParam = array())
    // {
    //     $sSelect = 'count(*)';
    //     $sTable  = 'tBhrJudgment';

    //     $sSql = "
    //     SELECT {$sSelect}
    //     FROM {$sTable} ";

    //     return DB::connection('ACAD')->select($sSql);
    // }

    public static function tBhrJudgmentSetting($aParam = array())
    {
        //第一次載入時直接查詢當前學年度的資料

        $sJudge_srh = isset($aParam['sJudge_srh']) ? $aParam['sJudge_srh'] : null;
        $sName_srh  = isset($aParam['sName_srh']) ? $aParam['sName_srh'] : null;

        $aWhere = array();

        $aParam = array();

        if ($sJudge_srh) {
            $aWhere[] = array('a.JudgmentKindID = ?', $sJudge_srh);
        }
        if ($sName_srh) {
            $aWhere[] = array('a.JudgmentContent LIKE ?', '%' . $sName_srh . '%');
        }

        $aWhereInfo = BaseModel::setWhere($aWhere);

        $aField = array_keys(
            array(
                "a.JudgmentID"       => "操行評語ID",
                "a.JudgmentContent"  => "操行評語內容",
                "a.state"            => "狀態(0=> 停用，1=>使用中)",
                "b.JudgmentKindName" => "操行評語分類ID",
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = 'tBhrJudgment';

        $sSql = "
        SELECT {$sSelect}
        FROM {$sTable} a
            LEFT JOIN tBhrJudgmentKind b ON a.JudgmentKindID = b.JudgmentKindID
        WHERE " . $aWhereInfo['where'] .
            " ORDER BY a.UpdateDate";

        return DB::connection('ACAD')->select($sSql, $aWhereInfo['param']);
    }
}
