<?php

namespace App\Database\ACAD\tEducationMinistryData\Repo;

use Illuminate\Support\Facades\DB;

class tEducationMinistryDataRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tEducationMinistryData";
        $this->Msg   = "教育部代碼";
    }
}
