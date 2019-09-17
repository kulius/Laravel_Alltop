<?php

namespace App\Database\ACAD\tCouStdProblemType\Repo;

use Illuminate\Support\Facades\DB;

class tCouStdProblemTypeRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tCouStdProblemType";
        $this->Msg   = "學生問題類別明細";
    }
}
