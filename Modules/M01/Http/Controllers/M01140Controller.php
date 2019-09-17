<?php

namespace Modules\m01\Http\Controllers;

use App;
use App\Alltop\Combo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class M01140Controller extends Controller
{
    public function __construct(Combo $combo)
    {
        $this->Combo = $combo;
    }

    //
    public function index(Request $request)
    {
        App::setLocale('en');

        return view('m01::M01140.index');
    }

    public function Stda2(Request $request)
    {

        $sACADYear_srh = $request->get('ACADYear_srh')[0];
        $sSemester_srh = $request->get('Semester_srh')[0];
        // $sActName_srh  = $request->get('ActName_srh')[0];

        //學年
        $aYear = $this->Combo->Year_combo();
        //學期
        $aSemester = $this->Combo->Semester_combo();
        //活動名稱
        // $aActName = $this->Combo->ActName_combo();

        $request->flash();

        return view('m01::M01140.Jump.Stda2', array(
            'aYear'     => $aYear,
            'aSemester' => $aSemester,
            //'aActName'  => $aActName,

        ));
    }

    public function Stda(Request $request)
    {

        $sACADYear_srh = $request->get('ACADYear_srh')[0];
        $sSemester_srh = $request->get('Semester_srh')[0];
        // $sActName_srh  = $request->get('ActName_srh')[0];

        //學年
        $aYear = $this->Combo->Year_combo();
        //學期
        $aSemester = $this->Combo->Semester_combo();
        //活動名稱
        // $aActName = $this->Combo->ActName_combo();

        $request->flash();

        return view('m01::M01140.Jump.Stda', array(
            'aYear'     => $aYear,
            'aSemester' => $aSemester,
            //'aActName'  => $aActName,

        ));
    }

    public function Stda3(Request $request)
    {

        $sACADYear_srh = $request->get('ACADYear_srh')[0];
        $sSemester_srh = $request->get('Semester_srh')[0];
        // $sActName_srh  = $request->get('ActName_srh')[0];

        //學年
        $aYear = $this->Combo->Year_combo();
        //學期
        $aSemester = $this->Combo->Semester_combo();
        //活動名稱
        // $aActName = $this->Combo->ActName_combo();

        $request->flash();

        return view('m01::M01140.Jump.Stda3', array(
            'aYear'     => $aYear,
            'aSemester' => $aSemester,
            //'aActName'  => $aActName,

        ));
    }
}
