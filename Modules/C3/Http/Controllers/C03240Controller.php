<?php

namespace Modules\C3\Http\Controllers;

use App;
use App\Alltop\Combo;
use App\Alltop\Common;
use App\Database\ACAD\ACADSysvar\Model\tACADSysvar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class C03240Controller extends Controller
{
    // 主畫面
    public function __construct(Combo $combo)
    {
        $this->oCombo = $combo;
    }

    /**
     * 查詢主頁
     */
    public function index(Request $request)
    {
        App::setLocale('en');
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
        $data    = array();
// $data['op']= array("aYearOp");
        // $$data['op'][0]

// $dataOp[$$data['op'][0]];
        // $data
        return view('c3::C03240.index', array(
            'data'    => $data,
            //Op
            'aYearOp' => $aYearOp,
            'aSemOp'  => $aSemOp,

            //Value
            'sYear'   => $sYear,
            'sSem'    => $sSem,

        ));
    }

    // 頁籤二
    public function tab2(Request $request)
    {
        App::setLocale('en');
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

        $aCollegeOp = $this->oCombo->College_combo(array('DayfgID' => $sDayfgID, 'ClassTypeID' => $sClassTypeID));
        $sCollegeID = Common::VarPriority(array('index' => 'CollegeID', 'def' => isset($aCollegeOp[0]['value']) ? $aCollegeOp[0]['value'] : ''));

        $aUnitOp = $this->oCombo->UnitYear_combo(array('ACADYear' => $sYear, 'DayfgID' => $sDayfgID, 'ClassTypeID' => $sClassTypeID, 'CollegeID' => $sCollegeID));

        $sUnitID = Common::VarPriority(array('index' => 'UnitID', 'def' => isset($aUnitOp[0]['value']) ? $aUnitOp[0]['value'] : ''));

        $aStudyGroupOp = $this->oCombo->StudyGroup_combo(array('DayfgID' => $sDayfgID, 'ClassTypeID' => $sClassTypeID, 'UnitID' => $sUnitID));
        $sStudyGroupID = Common::VarPriority(array('index' => 'StudyGroupID', 'def' => isset($aStudyGroupOp[0]['value']) ? $aStudyGroupOp[0]['value'] : ''));

        $aGradeOp = $this->oCombo->Grade_combo(array('DayfgID' => $sDayfgID, 'ClassTypeID' => $sClassTypeID, 'UnitID' => $sUnitID));
        $sGradeID = Common::VarPriority(array('index' => 'GradeID', 'def' => isset($aGradeOp[0]['value']) ? $aGradeOp[0]['value'] : ''));

        $aClassYearOp = $this->oCombo->ClassYear_combo(array('ACADYear' => $sYear, 'Semester' => $sSem, 'DayfgID' => $sDayfgID, 'ClassTypeID' => $sClassTypeID, 'UnitID' => $sUnitID, 'StudyGroupID' => $sStudyGroupID, 'GradeID' => $sGradeID));
        $sClassYearID = Common::VarPriority(array('index' => 'ClassYearID', 'def' => isset($aClassYearOp[0]['value']) ? $aClassYearOp[0]['value'] : ''));

        $data = array();
// $data['op']= array("aYearOp");
        // $$data['op'][0]

// $dataOp[$$data['op'][0]];
        // $data
        return view('c3::C03240.tab2', array(
            'data'          => $data,
            //Op
            'aYearOp'       => $aYearOp,
            'aSemOp'        => $aSemOp,
            'aDfgOp'        => $aDfgOp,
            'aClassTypeOp'  => $aClassTypeOp,
            'aCollegeOp'    => $aCollegeOp,
            'aUnitOp'       => $aUnitOp,
            'aStudyGroupOp' => $aStudyGroupOp,
            'aGradeOp'      => $aGradeOp,
            'aClassYearOp'  => $aClassYearOp,

            //Value
            'sYear'         => $sYear,
            'sDayfgID'      => $sDayfgID,
            'sSem'          => $sSem,
            'sClassTypeID'  => $sClassTypeID,
            'sCollegeID'    => $sCollegeID,
            'sUnitID'       => $sUnitID,
            'sStudyGroupID' => $sStudyGroupID,
            'sGradeID'      => $sGradeID,
            'sClassYearID'  => $sClassYearID,
        ));
    }
}
