<?php

namespace App\Database\ACAD\tELCClassCourseTeacher\Repo;

use App\Alltop\BaseModel;
use Illuminate\Support\Facades\DB;

class tELCClassCourseTeacherRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tELCClassCourseTeacher";
        $this->Msg   = "語言班級課程教師";
    }
}
