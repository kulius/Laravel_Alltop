<?php

namespace App\Database\ACAD\tClassType\Repo;

use Illuminate\Support\Facades\DB;

class tClassTypeRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tClassType";
        $this->Msg   = "學制";
    }

}
