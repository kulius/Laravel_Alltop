<?php

namespace App\Database\ACAD\tCusClassRoomCondition\Repo;

use Illuminate\Support\Facades\DB;

class tCusClassRoomConditionRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tCusClassRoomCondition";
        $this->Msg   = "常用教室優先群組";
    }

}
