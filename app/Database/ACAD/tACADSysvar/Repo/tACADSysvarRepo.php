<?php

namespace App\Database\ACAD\ACADSysvar\Repo;

class tACADSysvarRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tACADSysvar";
        $this->Msg   = "教務系統參數";
    }
}
