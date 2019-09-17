<?php

namespace App\Database\ACAD\tBhrStdAbsent\Repo;

use Illuminate\Support\Facades\DB;

class tBhrStdAbsentRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tBhrStdAbsent";
        $this->Msg   = "學生請假單";
    }
}
