<?php

namespace App\Database\ACAD\tBhrStdRPDataStu\Repo;

use Illuminate\Support\Facades\DB;

class tBhrStdRPDataStuRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tBhrStdRPDataStu";
        $this->Msg   = "學生獎懲明細";
    }
}
