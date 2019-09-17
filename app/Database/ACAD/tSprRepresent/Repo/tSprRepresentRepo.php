<?php
namespace App\Database\ACAD\tSprRepresent\Repo;

use Illuminate\Support\Facades\DB;

class tSprRepresentRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tSprRepresent";
        $this->Msg   = "代表隊";
    }

}
