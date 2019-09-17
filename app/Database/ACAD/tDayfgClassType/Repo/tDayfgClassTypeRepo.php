<?php

namespace App\Database\ACAD\tDayfgClassType\Repo;

use Illuminate\Support\Facades\DB;

class tDayfgClassTypeRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tDayfgClassType";
        $this->Msg   = "部別學制關聯";
    }
}
