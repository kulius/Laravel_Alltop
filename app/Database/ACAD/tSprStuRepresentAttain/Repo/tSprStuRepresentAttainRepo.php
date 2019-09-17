<?php
namespace App\Database\ACAD\tSprStuRepresentAttain\Repo;

use Illuminate\Support\Facades\DB;

class tSprStuRepresentAttainRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tSprStuRepresentAttain";
        $this->Msg   = "代表隊隊員成就";
    }

}
