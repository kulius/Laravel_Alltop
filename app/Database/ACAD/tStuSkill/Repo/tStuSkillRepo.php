<?php

namespace App\Database\ACAD\tStuSkill\Repo;

use Illuminate\Support\Facades\DB;

class tStuSkillRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tStuSkill";
        $this->Msg   = "特殊專長";
    }
}
