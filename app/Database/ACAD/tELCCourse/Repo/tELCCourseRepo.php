<?php

namespace App\Database\ACAD\tELCCourse\Repo;

use App\Alltop\BaseModel;
use Illuminate\Support\Facades\DB;

class tELCCourseRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tELCCourse";
        $this->Msg   = "語言班科目";
    }
}
