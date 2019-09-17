<?php

namespace App\Database\ACAD\tStuChgReason\Repo;

use Illuminate\Support\Facades\DB;

class tStuChgReasonRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tStuChgReason";
        $this->Msg   = "學籍異動類別";
    }
}
