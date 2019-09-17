<?php
namespace App\Database\ACAD\tBhrStdRollCall\Repo;

class tBhrStdRollCallRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tBhrStdRollCall";
        $this->Msg   = "學生點名";
    }
}
