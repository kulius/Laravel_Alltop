<?php

namespace App\Database\eOffice\tSysDemand\Repo;

use Illuminate\Support\Facades\DB;

class tSysDemandRepo
{
    public function __construct()
    {
        $this->DB    = "eOffice";
        $this->Table = "tSysDemand";
        $this->Msg   = "需求單";
    }

    //需求反應單填報資料設定
    public static function DemandSetting(array $aParam = array())
    {
        $sLoginUser = isset($aParam['sLoginUser']) ? $aParam['sLoginUser'] : null;
        //文字欄位值
        $sDemandNo_srh     = isset($aParam['sDemandNo_srh']) ? $aParam['sDemandNo_srh'] : null;
        $sFiller_srh       = isset($aParam['sFiller_srh']) ? $aParam['sFiller_srh'] : null;
        $sFillTimeStart    = isset($aParam['sFillTimeStart']) ? $aParam['sFillTimeStart'] : null;
        $sFillTimeEnd      = isset($aParam['sFillTimeEnd']) ? $aParam['sFillTimeEnd'] : null;
        $sDemandTimeStart  = isset($aParam['sDemandTimeStart']) ? $aParam['sDemandTimeStart'] : null;
        $sDemandTimeEnd    = isset($aParam['sDemandTimeEnd']) ? $aParam['sDemandTimeEnd'] : null;
        $sProcessReply_srh = isset($aParam['sProcessReply_srh']) ? $aParam['sProcessReply_srh'] : null;

        //下拉值
        $sFillUnit_srh       = isset($aParam['sFillUnit_srh']) ? $aParam['sFillUnit_srh'] : null;
        $sSystemName_srh     = isset($aParam['sSystemName_srh']) ? $aParam['sSystemName_srh'] : null;
        $sFunctionName_srh   = isset($aParam['sFunctionName_srh']) ? $aParam['sFunctionName_srh'] : null;
        $sKind_srh           = isset($aParam['sKind_srh']) ? $aParam['sKind_srh'] : null;
        $sProcessStatus_srh  = isset($aParam['sProcessStatus_srh']) ? $aParam['sProcessStatus_srh'] : null;
        $sCompleteStatus_srh = isset($aParam['sCompleteStatus_srh']) ? $aParam['sCompleteStatus_srh'] : null;
        $sRange_srh          = isset($aParam['sRange_srh']) ? $aParam['sRange_srh'] : 1;

        $sWhere = ' 1 = 1 ';

        $aParam = array();

        //查看範圍為個人時，帶入登入者帳號做篩選
        if ($sRange_srh == '1') {
            $sWhere .= " AND a.PNO = ? ";
            $aParam[] = $sLoginUser;
        }

        //欄位值查詢
        if ($sDemandNo_srh) {
            $sWhere .= " AND a.DemandNo = ? ";
            $aParam[] = $sDemandNo_srh;
        }
        if ($sFiller_srh) {
            $sWhere .= " AND a.Filler LIKE '%$sFiller_srh%'";
        }
        if ($sFillTimeStart && $sFillTimeEnd) {
            $sWhere .= " AND a.FillTime BETWEEN ? AND ? ";
            $aParam[] = $sFillTimeStart;
            $aParam[] = $sFillTimeEnd;
        }
        if ($sDemandTimeStart && $sDemandTimeEnd) {
            $sWhere .= " AND a.ApplyDate BETWEEN ? AND ? ";
            $aParam[] = $sDemandTimeStart;
            $aParam[] = $sDemandTimeEnd;
        }
        if ($sProcessReply_srh) {
            $sWhere .= " AND a.FillUnit LIKE '%$sProcessReply_srh#' ";
        }

        //下拉值查詢
        if ($sFillUnit_srh) {
            $sWhere .= " AND a.FillUnit = ? ";
            $aParam[] = $sFillUnit_srh;
        }
        if ($sSystemName_srh) {
            $sWhere .= " AND a.SystemName = ? ";
            $aParam[] = $sSystemName_srh;
        }
        if ($sFunctionName_srh) {
            $sWhere .= " AND a.FunctionName = ? ";
            $aParam[] = $sFunctionName_srh;
        }
        if ($sKind_srh) {
            $sWhere .= " AND a.Kind = ? ";
            $aParam[] = $sKind_srh;
        }

        if ($sProcessStatus_srh) {
            $sWhere .= " AND a.ProcessStatus = ? ";
            $aParam[] = $sProcessStatus_srh;
        }

        if ($sCompleteStatus_srh) {
            $sWhere .= " AND a.CompleteStatus = ? ";
            $aParam[] = $sCompleteStatus_srh;
        }

        $aField = array_keys(array(
            "a.ID"                             => "ID",
            "a.DemandNo"                       => "編號",
            "a.FillTime"                       => "填表時間",
            "a.FillUnit"                       => "填表單位",
            "a.PNO"                            => "填報人ID",
            "a.Filler"                         => "填報人",
            "a.Email"                          => "電子信箱",
            "a.Tel"                            => "電話",
            "b.paracodename AS SystemName"     => "系統名稱",
            "c.paracodename AS FunctionName"   => "功能名稱",
            "d.paracodename AS Kind"           => "分類",
            "a.RequireDescript"                => "需求描述",
            "a.ApplyDate"                      => "建立時間",
            "a.CompleteTime"                   => "完成時間",
            "a.ProcessReply"                   => "處理狀況",
            "e.paracodename AS ProcessStatus"  => "處理進度",
            "a.ReplyStaff"                     => "處理人員",
            "f.paracodename AS CompleteStatus" => "完成狀況",
        ));

        $sSelect = implode(", ", $aField);
        $sTable  = 'tSysDemand';

        $sSql = "
        SELECT {$sSelect}
        FROM {$sTable} a
        LEFT JOIN tSysPara b ON b.parano = 'SystemName' AND a.SystemName = b.paracodeno
        LEFT JOIN tSysPara c ON c.parano = 'FunctionName' AND a.FunctionName = c.paracodeno
        LEFT JOIN tSysPara d ON d.parano = 'M07_Kind' AND a.Kind = d.paracodeno
        LEFT JOIN tSysPara e ON e.parano = 'ProcessStatus' AND a.ProcessStatus = e.paracodeno
        LEFT JOIN tSysPara f ON f.parano = 'CompleteStatus' AND a.CompleteStatus = f.paracodeno
        WHERE {$sWhere}
        AND a.DrawalStatus = '0'
        ORDER BY ID";

        return DB::connection('eOffice')->select($sSql, $aParam);
    }

    //登入者資料
    public static function LoginUserMes($PNO)
    {
        $aField = array_keys(array(
            "PNO"     => "員工編號",
            "CNAME"   => "員工名稱",
            "DEPNO"   => "員工所屬單位編號",
            "DEPNAME" => "單位名稱",
            "EMAIL"   => "員工信箱",
            "TEL1"    => "員工電話",
        ));
        $sPNO    = $PNO;
        $sSelect = implode(", ", $aField);
        $sTable  = '[SCHOOL].[vEMPPEO]';

        $sSql = "
        SELECT {$sSelect}
        FROM {$sTable}
        WHERE PNO ='" . $sPNO . "'";

        return DB::connection('eOffice')->select($sSql);
    }

    //流水號
    public static function SerialNum()
    {
        $aField = array_keys(array(
            "CASE WHEN Max(Right(DemandNo,3)) = null
                THEN '001'
                ELSE Max(Right(DemandNo,3))+1
                END AS Num" => "員工編號",
        ));

        $sSelect = implode(", ", $aField);
        $sTable  = 'tSysDemand';

        $sSql = "
        SELECT {$sSelect}
        FROM {$sTable}";

        $Num = DB::connection('eOffice')->select($sSql);
        if ($Num[0]['Num'] == null) {
            $sNum = '001';
        } elseif ($Num[0]['Num'] < 10) {
            $sNum = '00' . $Num[0]['Num'];
        } elseif ($Num[0]['Num'] >= 10 && $Num[0]['Num'] < 100) {
            $sNum = '0' . $Num[0]['Num'];
        } else {
            $sNum = $Num[0]['Num'];
        }

        return $sNum;
    }

//下拉 待調整
    //填報單位
    public function FillUnit_Combo()
    {
        $aField = array_keys(array(
            "DEPNO AS [value]"  => "單位代碼",
            "DEPNAME AS [text]" => "填報單位",
        ));

        $sSelect = implode(", ", $aField);

        $sTable = '[SCHOOL].[vEMPDEP]';

        $sSql = "
         SELECT {$sSelect}
           FROM {$sTable}
           ORDER BY DEPNO";

        return DB::connection('eOffice')->select($sSql);
    }

    //系統
    public function SystemName_Combo()
    {
        $aField = array_keys(array(
            "paracodeno AS [value]"  => "代碼",
            "paracodename AS [text]" => "代碼名稱",
        ));

        $sSelect = implode(", ", $aField);

        $sTable = 'tSysPara';

        $sSql = "
         SELECT {$sSelect}
           FROM {$sTable}
           WHERE parano = 'SystemName'
           ORDER BY paracodeno";
        return DB::connection('eOffice')->select($sSql);
    }

    //功能
    public function FunctionName_Combo($SystemName = null)
    {
        $aField = array_keys(array(
            "paracodeno AS [value]"  => "代碼",
            "paracodename AS [text]" => "代碼名稱",
        ));

        $sWhere = " parano = 'FunctionName' ";

        if ($SystemName != null && $SystemName != 'other') {
            $sWhere .= " AND Left(paracodename,3) = '" . $SystemName . "'";
        }

        $sSelect = implode(", ", $aField);

        $sTable = 'tSysPara';

        $sSql = "
         SELECT {$sSelect}
           FROM {$sTable}
           WHERE {$sWhere}
           ORDER BY paracodeno";

        return DB::connection('eOffice')->select($sSql);
    }

    //分類
    public function Kind_Combo()
    {
        $aField = array_keys(array(
            "paracodeno AS [value]"  => "代碼",
            "paracodename AS [text]" => "代碼名稱",
        ));

        $sSelect = implode(", ", $aField);

        $sTable = 'tSysPara';

        $sSql = "
         SELECT {$sSelect}
           FROM {$sTable}
           WHERE parano = 'M07_Kind'
           ORDER BY paracodeno";

        return DB::connection('eOffice')->select($sSql);
    }

    //處理進度
    public function ProcessStatus_Combo($channel)
    {
        $aField = array_keys(array(
            "paracodeno AS [value]"  => "代碼",
            "paracodename AS [text]" => "代碼名稱",
        ));

        $sSelect = implode(", ", $aField);

        $sTable = 'tSysPara';

        switch ($channel) {
            case '1':
                $sWhere = " parano = 'ProcessStatus' ";
                break;

            case '2':
                $sWhere = " parano = 'ProcessStatus' AND paracodeno IN('6','7','9','10','13') ";
                break;

            default:
                break;
        }

        $sSql = "
         SELECT {$sSelect}
           FROM {$sTable}
           WHERE {$sWhere}
           ORDER BY paracodeno";

        return DB::connection('eOffice')->select($sSql);
    }

    //完成狀況
    public function CompleteStatus_Combo()
    {
        $aField = array_keys(array(
            "paracodeno AS [value]"  => "代碼",
            "paracodename AS [text]" => "代碼名稱",
        ));

        $sSelect = implode(", ", $aField);

        $sTable = 'tSysPara';

        $sSql = "
         SELECT {$sSelect}
           FROM {$sTable}
           WHERE parano = 'CompleteStatus'
           ORDER BY paracodeno";

        return DB::connection('eOffice')->select($sSql);
    }

    //查看範圍
    public function Range_Combo()
    {
        $aField = array_keys(array(
            "paracodeno AS [value]"  => "代碼",
            "paracodename AS [text]" => "代碼名稱",
        ));

        $sSelect = implode(", ", $aField);

        $sTable = 'tSysPara';

        $sSql = "
         SELECT {$sSelect}
           FROM {$sTable}
           WHERE parano = 'M07Range'
           ORDER BY paracodeno";

        return DB::connection('eOffice')->select($sSql);
    }

/************************************************需求單維護********************************************************************/

    //需求反應單維護資料設定
    public static function AlltopSetting(array $aParam = array())
    {
        $sLoginUser = isset($aParam['sLoginUser']) ? $aParam['sLoginUser'] : null;
        //文字欄位值
        $sDemandNo_srh     = isset($aParam['sDemandNo_srh']) ? $aParam['sDemandNo_srh'] : null;
        $sFiller_srh       = isset($aParam['sFiller_srh']) ? $aParam['sFiller_srh'] : null;
        $sFillTimeStart    = isset($aParam['sFillTimeStart']) ? $aParam['sFillTimeStart'] : null;
        $sFillTimeEnd      = isset($aParam['sFillTimeEnd']) ? $aParam['sFillTimeEnd'] : null;
        $sDemandTimeStart  = isset($aParam['sDemandTimeStart']) ? $aParam['sDemandTimeStart'] : null;
        $sDemandTimeEnd    = isset($aParam['sDemandTimeEnd']) ? $aParam['sDemandTimeEnd'] : null;
        $sProcessReply_srh = isset($aParam['sProcessReply_srh']) ? $aParam['sProcessReply_srh'] : null;

        //下拉值
        $sFillUnit_srh       = isset($aParam['sFillUnit_srh']) ? $aParam['sFillUnit_srh'] : null;
        $sSystemName_srh     = isset($aParam['sSystemName_srh']) ? $aParam['sSystemName_srh'] : null;
        $sFunctionName_srh   = isset($aParam['sFunctionName_srh']) ? $aParam['sFunctionName_srh'] : null;
        $sKind_srh           = isset($aParam['sKind_srh']) ? $aParam['sKind_srh'] : null;
        $sProcessStatus_srh  = isset($aParam['sProcessStatus_srh']) ? $aParam['sProcessStatus_srh'] : null;
        $sCompleteStatus_srh = isset($aParam['sCompleteStatus_srh']) ? $aParam['sCompleteStatus_srh'] : null;
        $sRange_srh          = isset($aParam['sRange_srh']) ? $aParam['sRange_srh'] : 1;

        $sWhere = ' 1 = 1 ';

        $aParam = array();

        //查看範圍為個人時，帶入登入者帳號做篩選
        if ($sRange_srh == '1') {
            $sWhere .= " AND a.ReplyStaff = ? ";
            $aParam[] = $sLoginUser;
        }

        //欄位值查詢
        if ($sDemandNo_srh) {
            $sWhere .= " AND a.DemandNo = ? ";
            $aParam[] = $sDemandNo_srh;
        }
        if ($sFiller_srh) {
            $sWhere .= " AND a.Filler LIKE '%$sFiller_srh%'";
        }
        if ($sFillTimeStart && $sFillTimeEnd) {
            $sWhere .= " AND a.FillTime BETWEEN ? AND ? ";
            $aParam[] = $sFillTimeStart;
            $aParam[] = $sFillTimeEnd;
        }
        if ($sDemandTimeStart && $sDemandTimeEnd) {
            $sWhere .= " AND DemandTime BETWEEN ? AND ? ";
            $aParam[] = $sDemandTimeStart;
            $aParam[] = $sDemandTimeEnd;
        }
        if ($sProcessReply_srh) {
            $sWhere .= " AND FillUnit LIKE '%$sProcessReply_srh#' ";
        }

        //下拉值查詢
        if ($sFillUnit_srh) {
            $sWhere .= " AND a.FillUnit = ? ";
            $aParam[] = $sFillUnit_srh;
        }
        if ($sSystemName_srh) {
            $sWhere .= " AND a.SystemName = ? ";
            $aParam[] = $sSystemName_srh;
        }
        if ($sFunctionName_srh) {
            $sWhere .= " AND a.FunctionName = ? ";
            $aParam[] = $sFunctionName_srh;
        }
        if ($sKind_srh) {
            $sWhere .= " AND a.Kind = ? ";
            $aParam[] = $sKind_srh;
        }

        if ($sProcessStatus_srh) {
            $sWhere .= " AND a.ProcessStatus = ? ";
            $aParam[] = $sProcessStatus_srh;
        }

        if ($sCompleteStatus_srh) {
            $sWhere .= " AND a.CompleteStatus = ? ";
            $aParam[] = $sCompleteStatus_srh;
        }

        $aField = array_keys(array(
            "a.ID"                             => "ID",
            "a.DemandNo"                       => "編號",
            "a.FillTime"                       => "填表時間",
            "a.FillUnit"                       => "填表單位",
            "a.PNO"                            => "填報人ID",
            "a.Filler"                         => "填報人",
            "a.Email"                          => "電子信箱",
            "a.Tel"                            => "電話",
            "b.paracodename AS SystemName"     => "系統名稱",
            "c.paracodename AS FunctionName"   => "功能名稱",
            "d.paracodename AS Kind"           => "分類",
            "a.RequireDescript"                => "需求描述",
            "a.DemandTime"                     => "需求時間",
            "a.CompleteTime"                   => "完成時間",
            "a.ProcessReply"                   => "處理狀況",
            "e.paracodename AS ProcessStatus"  => "處理進度",
            "a.ReplyStaff"                     => "處理人員",
            "f.paracodename AS CompleteStatus" => "完成狀況",
        ));

        $sSelect = implode(", ", $aField);
        $sTable  = 'tSysDemand';

        $sSql = "
        SELECT {$sSelect}
        FROM {$sTable} a
        LEFT JOIN tSysPara b ON b.parano = 'SystemName' AND a.SystemName = b.paracodeno
        LEFT JOIN tSysPara c ON c.parano = 'FunctionName' AND a.FunctionName = c.paracodeno
        LEFT JOIN tSysPara d ON d.parano = 'M07_Kind' AND a.Kind = d.paracodeno
        LEFT JOIN tSysPara e ON e.parano = 'ProcessStatus' AND a.ProcessStatus = e.paracodeno
        LEFT JOIN tSysPara f ON f.parano = 'CompleteStatus' AND a.CompleteStatus = f.paracodeno
        WHERE {$sWhere}
        ORDER BY ID";

        return DB::connection('eOffice')->select($sSql, $aParam);
    }
}
