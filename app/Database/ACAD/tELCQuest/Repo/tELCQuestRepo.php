<?php

namespace App\Database\ACAD\tELCQuest\Repo;

use Illuminate\Support\Facades\DB;

class tELCQuestRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tELCQuest";
        $this->Msg   = "報名題目";
    }
}
