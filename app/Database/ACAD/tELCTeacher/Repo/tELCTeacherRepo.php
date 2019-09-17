<?php

namespace App\Database\ACAD\tELCTeacher\Repo;

use App\Alltop\BaseModel;
use Illuminate\Support\Facades\DB;

class tELCTeacherRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tELCTeacher";
        $this->Msg   = "語言班教師資料";
    }
}
