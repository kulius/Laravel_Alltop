<?php

namespace App\Database\ACAD\tClassNoCategory\Repo;

use Illuminate\Database\Eloquent\Model;

class tClassNoCategoryRepo extends Model
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tClassNoCategory";
        $this->Msg   = "班別";
    }
}
