<?php

namespace App\Database\ACAD\tCusCourseClass\Repo;

use Illuminate\Support\Facades\DB;

class tCusCourseClassRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tCusCourseClass";
        $this->Msg   = "節次名稱資料表";
    }

}
