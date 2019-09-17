<?php

namespace App\Database\ACAD\tCusSection\Repo;

use Illuminate\Support\Facades\DB;

class tCusSectionRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tCusSection";
        $this->Msg   = "節次名稱資料表";
    }

}
