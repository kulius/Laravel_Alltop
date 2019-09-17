<?php

namespace App\Database\ACAD\tBhrStdRPDataReasonClass\Repo;

use Illuminate\Support\Facades\DB;

class tBhrStdRPDataReasonClassRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tBhrStdRPDataReasonClass";
        $this->Msg   = "學生獎懲支數明細";
    }
}
