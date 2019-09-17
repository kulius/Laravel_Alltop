<?php

namespace App\Database\ACAD\tDayfg\Repo;

use Illuminate\Support\Facades\DB;

class tDayfgRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tDayfg";
        $this->Msg   = "部別";
    }

    public function read()
    {

        $sWhere = ' 1 = 1 ';

        $aField = array_keys(array(
            "DayfgID"        => "部別ID",
            "Dayfg"          => "部別代碼",
            "DayfgName"      => "部別名稱",
            "DayfgENGName"   => "部別英文名稱",
            "state"          => "狀態",
            "DayfgAlias"     => "部別簡稱",
            "DayfgCus"       => "【課程】部別碼",
            "Seq"            => "順序",
            "DayNightLevel"  => "日夜別",
            "DiplomaDayfgNo" => "畢業證書部別碼",
            "UpdateID"       => "最後異動者",
            "UpdateDate"     => "最後異動日期",
        ));

        $sSelect = implode(", ", $aField);
        $sTable  = 'tDayfg';

        $sSql = "
            SELECT {$sSelect}
              FROM {$sTable}
             WHERE {$sWhere}
          ORDER BY Dayfg";

        return DB::connection('ACAD')->select($sSql);
    }

}
