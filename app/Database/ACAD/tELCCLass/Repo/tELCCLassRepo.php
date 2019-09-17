<?php

namespace App\Database\ACAD\tELCCLass\Repo;

use App\Alltop\BaseModel;
use Illuminate\Support\Facades\DB;

class tELCCLassRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tELCCLass";
        $this->Msg   = "語言班級名稱";
    }
}
