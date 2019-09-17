<?php

namespace App\Database\ACAD\tCampInformationStd\Repo;

use Illuminate\Support\Facades\DB;

class tCampInformationStdRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tCampInformationStd";
        $this->Msg   = "夏令營消息來源";
    }
}
