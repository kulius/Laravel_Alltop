<?php

namespace App\Database\ACAD\tEducationMinistryDataGroup\Repo;

use Illuminate\Support\Facades\DB;

class tEducationMinistryDataGroupRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tEducationMinistryDataGroup";
        $this->Msg   = "教育部代碼";
    }
}
