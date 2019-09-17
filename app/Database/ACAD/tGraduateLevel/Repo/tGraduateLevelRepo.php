<?php

namespace App\Database\ACAD\tGraduateLevel\Repo;

class tSchoolEduRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tGraduateLevel";
        $this->Msg   = "畢業學校類別";
    }

}
