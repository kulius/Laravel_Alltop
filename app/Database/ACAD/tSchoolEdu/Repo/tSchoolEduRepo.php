<?php

namespace App\Database\ACAD\tSchoolEdu\Repo;

use Illuminate\Support\Facades\DB;

class tSchoolEduRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tSchoolEdu";
        $this->Msg   = "畢業學校";
    }

}
