<?php

namespace Modules\Example\Http\Controllers;

//use App\Http\Controllers\Controller;
use App\Alltop\JumpHandler;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class E00301Controller extends Controller
{
    
    public function index(){
        return view('example::E00301.index', array(
            'current' => 0,
        ));
    }
}
