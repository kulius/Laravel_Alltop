<?php

namespace Modules\Example\Http\Controllers;

//use App\Http\Controllers\Controller;
use App\Alltop\JumpHandler;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class E00000Controller extends Controller
{
    
    public function index(){
        return view('example::E00000.index', array(
            'current' => 0,
        ));
    }

    public function jump_sgl(){

        return view('example::E00000.jump.index_form_jump_sgl');
    }
    public function jump_mul(){

        return view('example::E00000.jump.index_form_jump_mul');
    }

    public function jump_sgl_handle(Request $request)
    {
        $sEvent       = $request->event;
        $sJumpSelName = $request->jump_tb_sel;
        $aJumpSel     = json_decode($request->jump_tb_sel, true);

        //Route::post()時，觸發 select event
        if ($sEvent == 'select') {
            $sScript = JumpHandler::setJumpSelData(array(
                'name' => 'jump_sgl', // dropbox 的 name
                "data"  => $aJumpSel, 
                "value" => "seq", //要帶回到 dropbox 的 key 值
                "text"  => array("data"), //要顯示在 dropbox 上的名稱, $aJumpSel[0]['data']
            ));
            //直接回傳 Js Script
            return $sScript; 
        }

        return view('example::E00000.jump.index_form_jump_sgl');
    }

    public function jump_mul_handle(Request $request)
    {
        $sEvent       = $request->event;
        $sJumpSelName = $request->jump_tb_sel;
        $aJumpSel     = json_decode($request->jump_tb_sel, true);

        //Route::post()時，觸發 select event
        if ($sEvent == 'select') {
            $sScript = JumpHandler::setJumpSelData(array(
                'name' => 'jump_mul', // dropbox 的 name
                "data"  => $aJumpSel, 
                "value" => "seq", //要帶回到 dropbox 的 key 值
                "text"  => array("data"), //要顯示在 dropbox 上的名稱, $aJumpSel[0]['data']
            ));
            //直接回傳 Js Script
            return $sScript; 
        }

        return view('example::E00000.jump.index_form_jump_sgl');
    }

}
