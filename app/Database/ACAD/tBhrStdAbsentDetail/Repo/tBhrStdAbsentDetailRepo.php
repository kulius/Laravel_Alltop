<?php

namespace App\Database\ACAD\tBhrStdAbsentDetail\Repo;

use Illuminate\Support\Facades\DB;

class tBhrStdAbsentDetailRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tBhrStdAbsentDetail";
        $this->Msg   = "學生請假單明細";
    }
}
