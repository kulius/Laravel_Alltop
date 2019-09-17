<?php
namespace App\Database\ACAD\tSprRepresentMember\Repo;

use Illuminate\Support\Facades\DB;

class tSprRepresentMemberRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tSprRepresentMember";
        $this->Msg   = "代表隊隊員";
    }

}
