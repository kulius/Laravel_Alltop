<?php

namespace App\Database\ACAD\tCouStdFollowTrack\Repo;

use Illuminate\Support\Facades\DB;

class tCouStdFollowTrackRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tCouStdFollowTrack";
        $this->Msg   = "學生後續處理方式明細";
    }
}
