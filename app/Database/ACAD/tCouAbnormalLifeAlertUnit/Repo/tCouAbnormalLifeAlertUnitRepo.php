<?php

namespace App\Database\ACAD\tCouAbnormalLifeAlertUnit\Repo;

use Illuminate\Support\Facades\DB;

class tCouAbnormalLifeAlertUnitRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tCouAbnormalLifeAlertUnit";
        $this->Msg   = "學生生活異狀通報單位";
    }
}
