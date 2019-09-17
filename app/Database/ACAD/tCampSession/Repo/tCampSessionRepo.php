<?php

namespace App\Database\ACAD\tCampSession\Repo;

use Illuminate\Support\Facades\DB;

class tCampSessionRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tCampSession";
        $this->Msg   = "夏令營梯次";
    }
}
