<?php

namespace App\Database\ACAD\tBhrStdGroupAbsent\Repo;

use Illuminate\Support\Facades\DB;

class tBhrStdGroupAbsentRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tBhrStdGroupAbsent";
        $this->Msg   = "團體公假";
    }
}
