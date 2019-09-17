<?php

namespace App\Database\ACAD\tStudentFamily\Repo;

use Illuminate\Support\Facades\DB;

class tStudentFamilyRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tStudentFamily";
        $this->Msg   = "學生家人";
    }
}
