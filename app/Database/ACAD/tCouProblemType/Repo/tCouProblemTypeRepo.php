<?php

namespace App\Database\ACAD\tCouProblemType\Repo;

use Illuminate\Support\Facades\DB;

class tCouProblemTypeRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tCouProblemType";
        $this->Msg   = "輔導問題類別參數檔";
    }

    // 問題類別下拉選項
    public function ProblemTypeOption()
    {
        $DbCon = DB::connection($this->DB);
        return $DbCon->table('tCouProblemType')->where('state', '=', '1')->select('ProblemID AS value', 'Content AS text')->get()->toArray();
    }

}
