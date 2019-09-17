<?php

namespace Modules\Example\Http\Controllers;

use App\Alltop\Combo;
use App\Alltop\Common;
use App\Database\ACAD\tEnrEnrollType\Model\tEnrEnrollType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AjaxComboController extends Controller
{

    public function __construct(Combo $combo)
    {
        $this->oCombo = $combo;
    }

//學年學期部別學制學院系所
    public function ClassTypeCombo(Request $request)
    {
        //dd($request->all());
        $aInput     = $request->all();
        $sYear      = $aInput['Year'] ?? null;
        $sSemester  = $aInput['Semester'] ?? null;
        $sDayfg     = $aInput['Dayfg'] ?? null;
        $sClassType = $aInput['ClassType'] ?? null;
        $sCollegeID = $aInput['CollegeID'] ?? null;
        //dd($aInput);
        $sReturn              = array();
        $sReturn['ClassType'] = $this->oCombo->ClassType_combo($aInput['Dayfg']);
        $sReturn['College']   = $this->oCombo->College_combo(array('DayfgID' => $aInput['Dayfg'], 'ClassTypeID' => $aInput['ClassType']));

        $sReturn['Unit'] = $this->oCombo->UnitYear_combo(array(
            'ACADYear'    => $sYear,
            'DayfgID'     => $sDayfg,
            'ClassTypeID' => $sClassType,
            'CollegeID'   => $sCollegeID,
        ));
        return response()->json($sReturn);
    }

    public function CollegeCombo(Request $request)
    {
        $aInput  = $request->all();
        $sReturn = $this->oCombo->College_combo($aInput['Dayfg'], $aInput['ClassTypeID']);
        dd($sReturn);
        return response()->json($sReturn);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $data       = array();
        $aInput     = Common::getInput($request->all());
        $sYear      = $aInput['Year'] ?? null;
        $sSemester  = $aInput['Semester'] ?? null;
        $sDayfg     = $aInput['Dayfg'] ?? null;
        $sClassType = $aInput['ClassType'] ?? null;
        $sCollege   = $aInput['College'] ?? null;
        $sUnit      = $aInput['Unit'] ?? null;

        $aYearCombo       = $this->oCombo->Year_combo($sYear, $sYear);
        $aSemesterCombo   = $this->oCombo->Semester_combo();
        $aEnrollTypeCombo = tEnrEnrollType::all('EnrollTypeID as value', 'EnrollTypeName as text')->toArray();
        $aDayfgCombo      = $this->oCombo->Dayfg_combo();
        $sDayfg           = $sDayfg ?? $aDayfgCombo['0']['value'];
        $aClassTypeCombo  = $this->oCombo->ClassType_combo($sDayfg);
        $sClassType       = $sClassType ?? $aClassTypeCombo['0']['value'];
        $aCollegeCombo    = $this->oCombo->College_combo(array('DayfgID' => $sDayfg, 'ClassTypeID' => $sClassType));
        $sCollege         = $sCollege ?? $aCollegeCombo['0']['value'] ?? null;

        $aUnitCombo = $this->oCombo->Unit_combo(array('DayfgID' => $sDayfg, 'ClassTypeID' => $sClassType, 'CollegeID' => $sCollege));
        $sUnit      = $sUnit ?? $aUnitCombo[0]['value'] ?? null;

        return view('example::AjaxCombo.index',
            array(
                'data'            => $data,
                'sYear'           => $sYear,
                'sSemester'       => $sSemester,
                'sDayfg'          => $sDayfg,
                'sClassType'      => $sClassType,
                'sCollege'        => $sCollege,
                'sUnit'           => $sUnit,
                'aYearCombo'      => $aYearCombo,
                'aSemesterCombo'  => $aSemesterCombo,
                'aDayfgCombo'     => $aDayfgCombo,
                'aClassTypeCombo' => $aClassTypeCombo,
                'aCollegeCombo'   => $aCollegeCombo,
                'aUnitCombo'      => $aUnitCombo,
            ));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('example::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('example::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('example::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
