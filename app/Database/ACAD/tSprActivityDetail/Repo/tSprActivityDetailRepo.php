<?php
namespace App\Database\ACAD\tSprActivityDetail\Repo;

use Illuminate\Support\Facades\DB;

class tSprActivityDetailRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tSprActivityDetail";
        $this->Msg   = "體育活動報名明細";
    }

}
