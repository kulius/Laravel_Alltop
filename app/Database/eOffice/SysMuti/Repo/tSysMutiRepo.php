<?php

namespace App\Database\eOffice\SysMuti\Repo;

use Illuminate\Support\Facades\DB;

class tSysMutiRepo
{
    public function __construct()
    {
        $this->DB    = "eOffice";
        $this->Table = "tSysMuti";
        $this->Msg   = "";
    }

    public function MutiControllerIndex()
    {
        $this->DbCon = DB::connection($this->DB);
        return $this->DbCon->table('tSysMuti AS a')
                    ->leftjoin('tSysMutiDetail AS b', 'a.MutiID', '=', 'b.MutiID')
                    ->select('a.MutiID', 'a.text', 'a.textarea', 'a.number', 'b.DetailID'
                        , 'b.text AS DetailText', 'b.textarea AS DetailTextarea')->get();
    }

    // public function MutiControllerView1()
    // {
    //     return $this->DbCon->table('tSysMuti')->get();
    // }
}
