<?php
namespace App\Database\ACAD\tSprStuRepresentCadre\Repo;

use Illuminate\Support\Facades\DB;

class tSprStuRepresentCadreRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tSprStuRepresentCadre";
        $this->Msg   = "代表隊隊員任職幹部";
    }

}
