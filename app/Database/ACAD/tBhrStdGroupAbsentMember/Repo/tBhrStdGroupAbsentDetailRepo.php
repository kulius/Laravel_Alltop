<?php

namespace App\Database\ACAD\tBhrStdGroupAbsentMember\Repo;

use Illuminate\Support\Facades\DB;

class tBhrStdGroupAbsentMemberRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tBhrStdGroupAbsentMember";
        $this->Msg   = "團體公假明細";
    }
}
