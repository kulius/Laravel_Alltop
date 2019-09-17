<?php

namespace App\Database\ACAD\tStuStudentOptDetail\Repo;

use App\Database\ACAD\ACADSysvar\Model\tStuStudentOpt;

class tStuStudentOptRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tStuStudentOpt";
        $this->Msg   = "學籍特殊欄位表";
    }

    public function StudentOpt(string $opt){
        //tStuStudentOpt::where
    }

}
