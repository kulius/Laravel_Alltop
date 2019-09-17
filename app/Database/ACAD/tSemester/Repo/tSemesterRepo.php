<?php

namespace App\Database\ACAD\tSemester\Repo;

use Illuminate\Support\Facades\DB;

class tSemesterRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tSemester";
        $this->Msg   = "學期";
    }

}
