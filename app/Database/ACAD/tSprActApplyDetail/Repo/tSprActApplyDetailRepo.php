<?php
namespace App\Database\ACAD\tSprActApplyDetail\Repo;

use Illuminate\Support\Facades\DB;

class tSprActApplyDetailRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tSprActApplyDetail";
        $this->Msg   = "體育活動報名明細";
    }

}
