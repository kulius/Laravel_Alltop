<?php

namespace App\Database\ACAD\tCusClassRoom\Repo;

use Illuminate\Support\Facades\DB;

class tCusClassRoomRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tCusClassRoom";
        $this->Msg   = "授課教室";
    }

}
