<?php
namespace App\Database\ACAD\tSprStuFitnessQuiz\Repo;

use Illuminate\Support\Facades\DB;

class tSprStuFitnessQuizRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tSprStuFitnessQuiz";
        $this->Msg   = "學生體適能";
    }

}
