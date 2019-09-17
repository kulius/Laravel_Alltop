<?php

namespace App\Database\ACAD\tStuDisability\Repo;

use Illuminate\Support\Facades\DB;

class tStuDisabilityRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tStuDisability";
        $this->Msg   = "生理狀況";
    }
}
