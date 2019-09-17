<?php

namespace App\Database\ACAD\tELCSeason\Repo;

use App\Alltop\BaseModel;
use Illuminate\Support\Facades\DB;

class tELCSeasonRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tELCSeason";
        $this->Msg   = "語言季別";
    }
}
