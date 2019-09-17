<?php

namespace App\Http\Controllers\ModuleNtue\NewStudent;

use App\Database\ACAD\tACADSysvar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class regSchoolNameController extends Controller
{
    //
    public function index(Request $request)
    {

        $customer_name    = tACADSysvar::where('var', 'customer_name')->first();
        $customer_engname = tACADSysvar::where('var', 'customer_engname')->first();
        $customer_code    = tACADSysvar::where('var', 'customer_code')->first();
        $customer_alias   = tACADSysvar::where('var', 'customer_alias')->first();

        return view('ModuleNtue.NewStudent.regSchoolName.index', array(
            'customer_name'    => $customer_name,
            'customer_engname' => $customer_engname,
            'customer_code'    => $customer_code,
            'customer_alias'   => $customer_alias,
        ));
    }

    public function save(Request $request, $status = null, $id = null)
    {

        $data = $request->all();

        $result = tACADSysvar::updateOrCreate(array('var' => 'customer_name'), array('name' => '報表學校名稱', 'content' => $data['customer_name']));
        $result = tACADSysvar::updateOrCreate(array('var' => 'customer_engname'), array('name' => '報表學校英文名稱', 'content' => $data['customer_engname']));
        $result = tACADSysvar::updateOrCreate(array('var' => 'customer_code'), array('name' => '學校代碼', 'content' => $data['customer_code']));
        $result = tACADSysvar::updateOrCreate(array('var' => 'customer_alias'), array('name' => '學校簡稱', 'content' => $data['customer_alias']));
        // $result = SysExample::create($data);

        if ($result) {
            Session::flash('sweet', array('success', '儲存動作執行成功！'));
        } else {
            Session::flash('sweet', array('error', '儲存動作執行失敗！'));
        }

        return redirect()->route('a01110');
    }

}
