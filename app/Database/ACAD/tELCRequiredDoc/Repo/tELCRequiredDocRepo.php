<?php

namespace App\Database\ACAD\tELCRequiredDoc\Repo;

use App\Alltop\BaseModel;
use Illuminate\Support\Facades\DB;

class tELCRequiredDocRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tELCRequiredDoc";
        $this->Msg   = "必要文件";
    }
}
