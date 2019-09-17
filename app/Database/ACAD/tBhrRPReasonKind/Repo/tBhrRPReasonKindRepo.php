<?php

namespace App\Database\ACAD\tBhrRPReasonKind\Repo;

use App\Database\ACAD\tBhrRPReasonKind\Repo\tBhrRPReasonKindRepo;
use Illuminate\Support\Facades\DB;

class tBhrRPReasonKindRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tBhrRPReasonKind";
        $this->Msg   = "獎懲條款";
    }

    //資料查詢
    public static function tBhrParaSetting($aParam = array())
    {
        $sBonusPenalty_srh = $aParam['sBonusPenalty_srh'] != '' ? $aParam['sBonusPenalty_srh'] : '申誡';

        $sWhere = ' 1 = 1 ';

        if ($sBonusPenalty_srh) {
            $sWhere .= " AND BonusPenaltyPara LIKE '%$sBonusPenalty_srh%' ";
        }

        $aField = array_keys(
            array(
                "RPReasonKindID"   => "獎懲事由種類ID",
                "BonusPenaltyPara" => "獎懲種類Para",
                "ReasonContent"    => "條款內容",
                "Clause"           => "條",
                "Article"          => "款",
                "Item"             => "項",
                "state"            => "停復用",
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = 'tBhrRPReasonKind';

        $sSql = "
        SELECT {$sSelect}
        FROM {$sTable}
        WHERE {$sWhere}
        ORDER BY Clause";

        return DB::connection('ACAD')->select($sSql);
    }

    //特製tPara下拉
    public static function tPara_Combo($aParam = array())
    {
        $aField = array_keys(array(
            "paracodename AS [value]" => "參數名稱",
            "paracodename AS [text]"  => "參數名稱",
        ));

        $sSelect = implode(", ", $aField);
        $sTable  = 'tPara';

        $sWhere = " parano = 'BonusPenalty' ";

        $sSql = "
         SELECT {$sSelect}
           FROM {$sTable}
          WHERE {$sWhere}
       ORDER BY paracodeno";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    // 獎懲項目下拉選項
    public function RPReasonKindOption($aParam = array())
    {
        $sSql = "SELECT RPReasonKindID AS value
                      , CAST(Clause AS VARCHAR) + '條-' + CAST(Article AS VARCHAR) + '款-' + CAST(ISNULL(Item, '0') AS VARCHAR) + '項: ' + ReasonContent AS text
                 FROM tBhrRPReasonKind WHERE state = ?";
        return DB::connection('ACAD')->select($sSql, array('1'));
    }
}
