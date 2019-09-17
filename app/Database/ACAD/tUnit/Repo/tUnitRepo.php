<?php

namespace App\Database\ACAD\tUnit\Repo;

use Illuminate\Support\Facades\DB;

class tUnitRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tUnit";
        $this->Msg   = "科系";
    }

}
