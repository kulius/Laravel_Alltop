<?php

namespace App\Database\ACAD\tTEEDUCTypeRepo\Repo;

use Illuminate\Support\Facades\DB;

class tTEEDUCTypeRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tTEEDUCType";
        $this->Msg   = "教育類別";
    }

}
