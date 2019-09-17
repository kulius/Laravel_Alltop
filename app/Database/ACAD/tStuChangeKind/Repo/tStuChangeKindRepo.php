<?php

namespace App\Database\ACAD\tStuChangeKind\Repo;

use Illuminate\Support\Facades\DB;

class tStuChangeKindRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tStuChangeKind";
        $this->Msg   = "學籍異動狀態";
    }
}
