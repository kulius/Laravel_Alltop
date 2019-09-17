<?php

namespace App\Database\ACAD\tUnitEdu\Repo;

use Illuminate\Support\Facades\DB;

class tUnitRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tUnitEdu";
        $this->Msg   = "畢業科系";
    }

}
