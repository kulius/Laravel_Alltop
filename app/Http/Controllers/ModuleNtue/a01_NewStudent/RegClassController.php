<?php

namespace App\Http\Controllers\ModuleNtue\a01_NewStudent;

use Illuminate\Http\Request;
use App\Database\ACAD\tDayfg;
use App\Database\ACAD\tSemester;
use App\Database\ACAD\tACADSysvar;
use App\Http\Controllers\Controller;

class RegClassController extends Controller
{
    //
    public function index(Request $request)
    {

        $aDayfg = tDayfg::Dayfg_combo();
        $aYearCombo = tACADSysvar::ACADYear_Combo();
        $aSemester = tSemester::cusSemester_Combo();
        return view('ModuleNtue.NewStudent.RegClass.index',
            array(
                'current' => 0,
                'aDayfg' => $aDayfg,
                'aYearCombo' => $aYearCombo,
                'aSemester' => $aSemester,
            )
        );
    }
}
