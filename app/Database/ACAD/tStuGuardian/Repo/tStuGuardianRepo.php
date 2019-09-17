<?php

namespace App\Database\ACAD\tStuGuardian\Repo;

use Illuminate\Support\Facades\DB;

class tStuGuardianRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tStuGuardian";
        $this->Msg   = "監護人";
    }
}
