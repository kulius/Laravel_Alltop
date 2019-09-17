<?php

namespace App\Database\ACAD\tStuChgReasonDetail\Repo;

use Illuminate\Support\Facades\DB;

class tStuChgReasonDetailRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tStuChgReasonDetail";
        $this->Msg   = "學籍異動類別原因";
    }
}
