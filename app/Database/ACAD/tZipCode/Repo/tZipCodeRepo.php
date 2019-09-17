<?php

namespace App\Database\ACAD\tZipCode\Repo;

use Illuminate\Support\Facades\DB;

class tUnitRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tZipCode";
        $this->Msg   = "郵遞區號";
    }

}
