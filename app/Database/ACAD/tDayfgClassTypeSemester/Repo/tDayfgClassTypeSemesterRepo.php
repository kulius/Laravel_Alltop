<?php

namespace App\Database\ACAD\tDayfgClassTypeSemester\Repo;

use Illuminate\Support\Facades\DB;

class tDayfgClassTypeSemesterRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tDayfgClassTypeSemester";
        $this->Msg   = "學制修改學期";
    }

}
