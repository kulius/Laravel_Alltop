<?php

namespace App\Database\ACAD\tCampStudent\Repo;

use Illuminate\Support\Facades\DB;

class tCampStudentRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tCampStudent";
        $this->Msg   = "夏令營學生";
    }

}
