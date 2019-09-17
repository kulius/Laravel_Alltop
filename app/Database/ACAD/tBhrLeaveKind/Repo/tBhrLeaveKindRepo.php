<?php
namespace App\Database\ACAD\tBhrLeaveKind\Repo;

use Illuminate\Support\Facades\DB;

class tBhrLeaveKindRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tBhrLeaveKind";
        $this->Msg   = "請假類別";
    }

    // 回傳假別資料
    public function LeaveKindOption()
    {
        $DbCon = DB::connection($this->DB);
        return $DbCon->table('tBhrLeaveKind')->where('state', '=', '1')->select('LeaveKindID AS value', 'LeaveKindName AS text')->get()->toArray();
    }

}
