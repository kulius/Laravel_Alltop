<?php

namespace App\Database\ACAD\tUnitYear\Repo;

use Illuminate\Support\Facades\DB;

class tUnitYearRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tUnitYear";
        $this->Msg   = "年度系所";
    }

}
