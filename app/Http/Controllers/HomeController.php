<?php

namespace App\Http\Controllers;

use App\Database\eOffice\SysBoard;

class HomeController extends Controller
{
    public function index()
    {
        $where   = array();
        $where[] = array('board_start_date', '<=', date('Y-m-d'));
        $where[] = array('board_end_date', '>=', date('Y-m-d'));

        $data_board = SysBoard::where($where)->get();

        return view('home', array('data_board' => $data_board));
    }

    public function modal_default()
    {
        return view('components.default_modal');
    }
}
