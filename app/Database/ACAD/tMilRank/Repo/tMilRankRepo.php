<?php

namespace App\Database\ACAD\MilRank\Repo;

class tMilServiceRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "MilRank";
        $this->Msg   = "軍階";
    }
}
