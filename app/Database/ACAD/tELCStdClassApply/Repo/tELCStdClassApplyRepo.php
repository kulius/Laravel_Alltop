<?php

namespace App\Database\ACAD\tELCStdClassApply\Repo;

use App\Alltop\BaseModel;
use Illuminate\Support\Facades\DB;

class tELCStdClassApplyRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tELCStdClassApply";
        $this->Msg   = "語言班學生上課申請";
    }
}
