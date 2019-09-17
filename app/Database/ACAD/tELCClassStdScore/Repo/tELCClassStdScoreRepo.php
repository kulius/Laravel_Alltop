<?php

namespace App\Database\ACAD\tELCClassStdScore\Repo;

use Illuminate\Support\Facades\DB;

class tELCClassStdScoreRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tELCClassStdScore";
        $this->Msg   = "語言班級學生";
    }

}
