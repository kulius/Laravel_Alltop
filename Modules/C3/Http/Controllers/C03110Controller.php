<?php

namespace Modules\C3\Http\Controllers;

use App;
use App\Alltop\Combo;
use App\Alltop\Common;
use App\Database\ACAD\ACADSysvar\Model\tACADSysvar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class C03110Controller extends Controller
{
    // 主畫面
    public function __construct(Combo $combo)
    {
        App::setLocale('en');
        $this->oCombo = $combo;
    }

    /**
     * 查詢主頁
     */
    public function index(Request $request)
    {
        // 當前route名稱
        $RouteName = Common::getRouteName($request);

        // 查詢條件: 優先使用POST，沒有POST使用SESSION
        if ($request->has('srh')) {
            Session::put($RouteName . '_srh', $request->get('srh'));
        } else {
            $request->request->set('srh', Session::get($RouteName . '_srh'));
        }

        $Year  = tACADSysvar::where(array('var' => 'stu_year'))->first()->content;
        $Sem   = tACADSysvar::where(array('var' => 'stu_semester'))->first()->content;
        $sYear = Common::VarPriority(array('index' => 'ACADYear', 'def' => $Year));
        $sSem  = Common::VarPriority(array('index' => 'Semester', 'def' => $Sem));

        $aYearOp = $this->oCombo->Year_Combo($sYear);
        $aSemOp  = $this->oCombo->Semester_combo();

        $aDfgOp = $this->oCombo->Dayfg_combo();
        // dd($aDfgOp);
        $sDayfgID = Common::VarPriority(array('index' => 'DayfgID', 'def' => isset($aDfgOp[0]['value']) ? $aDfgOp[0]['value'] : ''));

        $aClassTypeOp = $this->oCombo->ClassType_combo($sDayfgID);
        $sClassTypeID = Common::VarPriority(array('index' => 'ClassTypeID', 'def' => isset($aClassTypeOp[0]['value']) ? $aClassTypeOp[0]['value'] : ''));

        $data = array();
// $data['op']= array("aYearOp");
        // $$data['op'][0]

// $dataOp[$$data['op'][0]];
        // $data
        return view('c3::C03110.index', array(
            'data'         => $data,
            //Op
            'aYearOp'      => $aYearOp,
            'aSemOp'       => $aSemOp,
            'aDfgOp'       => $aDfgOp,
            'aClassTypeOp' => $aClassTypeOp,

            //Value
            'sYear'        => $sYear,
            'sDayfgID'     => $sDayfgID,
            'sSem'         => $sSem,
            'sClassTypeID' => $sClassTypeID,

        ));
    }
}
