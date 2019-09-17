<?php

namespace App\Database\ACAD\tBhrStdGroupAbsentDetail\Repo;

use Illuminate\Support\Facades\DB;

class tBhrStdGroupAbsentDetailRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tBhrStdGroupAbsentDetail";
        $this->Msg   = "團體公假明細";
    }
}
