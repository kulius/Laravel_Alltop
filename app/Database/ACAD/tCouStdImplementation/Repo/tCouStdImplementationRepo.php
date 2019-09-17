<?php

namespace App\Database\ACAD\tCouStdImplementation\Repo;

use Illuminate\Support\Facades\DB;

class tCouStdImplementationRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tCouStdImplementation";
        $this->Msg   = "學生實施方式明細";
    }
}
