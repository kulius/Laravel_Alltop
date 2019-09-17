<?php
namespace App\Database\ACAD\tSprRepresentUnit\Repo;

use Illuminate\Support\Facades\DB;

class tSprRepresentUnitRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tSprRepresentUnit";
        $this->Msg   = "系所代表";
    }

}
