<?php

namespace App\Database\ACAD\tSprActApply\Repo;

use Illuminate\Support\Facades\DB;

class tSprActApplyRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tSprActApply";
        $this->Msg   = "體育活動報名";
    }

}
