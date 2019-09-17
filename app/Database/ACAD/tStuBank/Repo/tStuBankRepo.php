<?php

namespace App\Database\ACAD\tStuBank\Repo;

use Illuminate\Support\Facades\DB;

class tStuBankRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tStuBank";
        $this->Msg   = "學生銀行帳號";
    }
}
