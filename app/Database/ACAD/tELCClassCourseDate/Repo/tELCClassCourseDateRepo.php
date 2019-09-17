<?php

namespace App\Database\ACAD\tELCCLass\Repo;

use App\Alltop\BaseModel;
use Illuminate\Support\Facades\DB;

class tELCClassCourseDateRepo
{
    public function __construct()
    {
        $this->DB                        = "ACAD";
        $this->Table                     = "tELCClassCourseDate";
        $this->Msg                       = "語言班上課時間";
    }
}
