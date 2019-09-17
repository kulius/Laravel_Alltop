<?php

namespace App\Database\ACAD\tELCLevel\Repo;

use App\Alltop\BaseModel;
use Illuminate\Support\Facades\DB;

class tELCReceiveDocRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tELCReceiveDoc";
        $this->Msg   = "接收文件";
    }
}
