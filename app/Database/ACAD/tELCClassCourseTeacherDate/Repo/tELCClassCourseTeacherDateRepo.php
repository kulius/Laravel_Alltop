<?php

namespace App\Database\ACAD\tELCClassCourseTeacher\Repo;

use Illuminate\Support\Facades\DB;

class tELCClassCourseTeacherDateRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tELCClassCourseTeacher";
        $this->Msg   = "語言班級課程教師";
    }
}
