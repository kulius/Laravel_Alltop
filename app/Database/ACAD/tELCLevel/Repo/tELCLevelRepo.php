<?php

namespace App\Database\ACAD\tELCLevel\Repo;

use App\Alltop\BaseModel;
use Illuminate\Support\Facades\DB;

class tELCLevelRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tELCLevel";
        $this->Msg   = "語言班語言程度";
    }
}
