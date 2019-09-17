<?php

namespace App\Database\ACAD\tStuModifyDate\Repo;

use Illuminate\Support\Facades\DB;

class tDayfgRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tStuModifyDate";
        $this->Msg   = "學生修改學籍時程表";
    }

}
