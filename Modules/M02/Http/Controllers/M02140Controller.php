<?php

namespace Modules\m02\Http\Controllers;

use App;
use App\Alltop\Combo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class M02140Controller extends Controller
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
            array('aaID' => '1', 'LastSignTime' => '2019/07/18 13:29:58:22', 'SignInIP' => '192.168.50.60'),
            array('aaID' => '2', 'LastSignTime' => '2019/07/16 13:29:58:22', 'SignInIP' => '192.168.50.61'),
            array('aaID' => '3', 'LastSignTime' => '2019/07/15 13:29:58:22', 'SignInIP' => '192.168.50.62'),
        );

        return view('m02::M02140.index', array(
            'data' => $data,
        ));

    }

}
