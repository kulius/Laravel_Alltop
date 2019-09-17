<?php

namespace App\Database\ACAD\tBhrMeetingKind\Repo;

use Illuminate\Support\Facades\DB;

class tBhrMeetingKindRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tBhrMeetingKind";
        $this->Msg   = "勤缺類別";
    }
}
