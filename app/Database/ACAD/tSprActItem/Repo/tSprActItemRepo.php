<?php
namespace App\Database\ACAD\tSprActItem\Repo;

use Illuminate\Support\Facades\DB;

class tSprActItemRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tSprActItem";
        $this->Msg   = "體育項目";
    }

}
