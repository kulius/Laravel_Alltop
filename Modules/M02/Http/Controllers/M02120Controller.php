<?php

namespace Modules\m02\Http\Controllers;

use App;
use App\Alltop\Combo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class M02120Controller extends Controller
{
    public function __construct(Combo $combo)
    {
        $this->Combo = $combo;
    }

    //
    public function index(Request $request)
    {
        App::setLocale('en');

        $data = array(
            array('aaID' => '1', 'ChangeDate' => '2019/07/19', 'ChangeTime' => '09:07', 'IP' => '192.19.192.16', 'ChangePeople' => ''),
            array('aaID' => '2', 'ChangeDate' => '2019/07/19', 'ChangeTime' => '09:07', 'IP' => '192.190.192.30', 'ChangePeople' => '系所管理員'),

        );

        return view('m02::M02120.index', array(
            'data' => $data,
        ));

    }

    public function view(Request $request, $status = null, $id = null)
    {
        App::setLocale('en');

        return view('m02::M02120.view', array(
            //'data' => $data,
            'status' => $status,
        ));

    }
}
