<?php
namespace App\Database\ACAD\tBhrSettleDateBatch\Repo;

use Illuminate\Support\Facades\DB;

class tBhrAbsentAlertLogRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tBhrSettleDateBatch";
        $this->Msg   = "各項時間結算設定";
    }
}
