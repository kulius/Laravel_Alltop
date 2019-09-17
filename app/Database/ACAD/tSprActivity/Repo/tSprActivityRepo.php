<?php
namespace App\Database\ACAD\tSprActivity\Repo;

use Illuminate\Support\Facades\DB;

class tSprActivityRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tSprActivity";
        $this->Msg   = "體育活動";
    }

}
