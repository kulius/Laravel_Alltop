<?php

namespace App\Database\ACAD\tELCSeason\Repo;

use Illuminate\Support\Facades\DB;

class tCusStudyCourseRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tCusStudyCourse";
        $this->Msg   = "課架";
    }
}
