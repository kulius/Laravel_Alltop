<?php

namespace App\Database\ACAD\tStuOrientation\Repo;

use Illuminate\Support\Facades\DB;

class tStuOrientationRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tStuOrientation";
        $this->Msg   = "學科興趣";
    }
}
