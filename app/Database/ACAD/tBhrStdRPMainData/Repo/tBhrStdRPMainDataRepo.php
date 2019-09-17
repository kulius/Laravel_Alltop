<?php

namespace App\Database\ACAD\tBhrStdRPMainData\Repo;

use Illuminate\Support\Facades\DB;

class tBhrStdRPMainDataRepo
{
    // 獎懲審核狀態下拉選項
    private $status_op;
    // 獎懲審核狀態文字
    private $status_text;

    public function __construct()
    {
        $this->DB        = "ACAD";
        $this->Table     = "tBhrStdRPMainData";
        $this->Msg       = "獎懲建議";
        $this->status_op = array(
            array('value' => '1', 'text' => '未送審'), array('value' => '2', 'text' => '送審中'),
            array('value' => '3', 'text' => '已決行'), array('value' => '4', 'text' => '退回修改'),
        );
        $this->status_text = array('1' => '未送審', '2' => '送審中', '3' => '已決行', '4' => '退回修改');
    }

    // 獎懲審核狀態下拉選項
    public function StatusOp()
    {
        return $this->status_op;
    }

    // 獎懲審核狀態文字
    public function StatusText()
    {
        return $this->status_text;
    }
}
