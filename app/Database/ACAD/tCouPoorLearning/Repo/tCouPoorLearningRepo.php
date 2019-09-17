<?php

namespace App\Database\ACAD\tCouPoorLearning\Repo;

use Illuminate\Support\Facades\DB;

class tCouPoorLearningRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tCouPoorLearning";
        $this->Msg   = "學習成效不佳參數檔";
    }

}
