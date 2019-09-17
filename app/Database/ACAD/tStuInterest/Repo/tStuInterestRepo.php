<?php

namespace App\Database\ACAD\tStuInterest\Repo;

use Illuminate\Support\Facades\DB;

class tStuInterestRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tStuInterest";
        $this->Msg   = "休閒興趣";
    }
}
