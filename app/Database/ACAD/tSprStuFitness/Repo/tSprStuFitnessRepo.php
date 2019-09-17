<?php
namespace App\Database\ACAD\tSprStuFitness\Repo;

use Illuminate\Support\Facades\DB;

class tSprStuFitnessRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tSprStuFitness";
        $this->Msg   = "學生身高體重";
    }

}
