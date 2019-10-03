<?php

namespace Modules\C3\Http\Controllers;

use App;
use App\Alltop\Combo;
use App\Alltop\Common;
use App\Database\ACAD\ACADSysvar\Model\tACADSysvar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class C03250Controller extends Controller
{
    public function __construct(Combo $combo)
    {
        $this->oCombo = $combo;
    }

    // 主畫面
    public function index(Request $request)
    {
        App::setLocale('en');
        $data = array();
        return view('c3::c03250.index', array(
            'data' => $data,
        ));
    }

    public function jump1(Request $request)
    {
        App::setLocale('en');
        $data = array();
        return view('c3::c03250.jump1', array(
            'data' => $data,
        ));
    }

    public function Jump2(Request $request, $id = null)
    {
        // 當前route名稱
        $RouteName = Common::getRouteName($request);

        // 查詢條件: 優先使用POST，沒有POST使用SESSION
        if ($request->has('srh')) {
            Session::put($RouteName . '_srh', $request->get('srh'));
        } else {
            $request->request->set('srh', Session::get($RouteName . '_srh'));
        }

        $Year      = tACADSysvar::where(array('var' => 'stu_year'))->first()->content;
        $Sem       = tACADSysvar::where(array('var' => 'stu_semester'))->first()->content;
        $sYear     = Common::VarPriority(array('index' => 'ACADYear', 'def' => $Year));
        $sSemester = Common::VarPriority(array('index' => 'Semester', 'def' => $Sem));

        $YearOp     = $this->oCombo->Year_Combo($sYear);
        $SemesterOp = $this->oCombo->Semester_combo();

        $aAllOption = array(array('value' => '', 'text' => '-'));

        $DayfgOp  = array_merge($aAllOption, $this->oCombo->Dayfg_combo());
        $sDayfgID = Common::VarPriority(array('index' => 'DayfgID', 'def' => isset($DayfgOp[0]['value']) ? $DayfgOp[0]['value'] : ''));

        $ClassTypeOp  = array_merge($aAllOption, $this->oCombo->ClassType_combo($sDayfgID));
        $sClassTypeID = Common::VarPriority(array('index' => 'ClassTypeID', 'def' => isset($ClassTypeOp[0]['value']) ? $ClassTypeOp[0]['value'] : ''));

        $CollegeOp  = array_merge($aAllOption, $this->oCombo->College_combo(array('DayfgID' => $sDayfgID, 'ClassTypeID' => $sClassTypeID)));
        $sCollegeID = Common::VarPriority(array('index' => 'CollegeID', 'def' => isset($CollegeOp[0]['value']) ? $CollegeOp[0]['value'] : ''));

        $UnitOp  = array_merge($aAllOption, $this->oCombo->UnitYear_combo(array('ACADYear' => $sYear, 'DayfgID' => $sDayfgID, 'ClassTypeID' => $sClassTypeID, 'CollegeID' => $sCollegeID)));
        $sUnitID = Common::VarPriority(array('index' => 'UnitID', 'def' => isset($UnitOp[0]['value']) ? $UnitOp[0]['value'] : ''));

        $StudyGroupOp  = array_merge($aAllOption, $this->oCombo->StudyGroup_combo(array('DayfgID' => $sDayfgID, 'ClassTypeID' => $sClassTypeID, 'UnitID' => $sUnitID)));
        $sStudyGroupID = Common::VarPriority(array('index' => 'StudyGroupID', 'def' => isset($StudyGroupOp[0]['value']) ? $StudyGroupOp[0]['value'] : ''));

        $GradeOp = array_merge($aAllOption, $this->oCombo->Grade_combo(array('DayfgID' => $sDayfgID, 'ClassTypeID' => $sClassTypeID, 'UnitID' => $sUnitID)));
        $sGrade  = Common::VarPriority(array('index' => 'Grade', 'def' => isset($GradeOp[0]['value']) ? $GradeOp[0]['value'] : ''));

        $ClassOp  = array_merge($aAllOption, $this->oCombo->ClassYear_combo(array('ACADYear' => $sYear, 'Semester' => $sSemester, 'DayfgID' => $sDayfgID, 'ClassTypeID' => $sClassTypeID, 'UnitID' => $sUnitID, 'StudyGroupID' => $sStudyGroupID, 'Grade' => $sGrade)));
        $sClassID = Common::VarPriority(array('index' => 'ClassID', 'def' => isset($ClassOp[0]['value']) ? $ClassOp[0]['value'] : ''));

        return view('c3::c03250.jump2', array(
            'sYear'         => $sYear,
            'sSemester'     => $sSemester,
            'sDayfgID'      => $sDayfgID,
            'sClassTypeID'  => $sClassTypeID,
            'sCollegeID'    => $sCollegeID,
            'sUnitID'       => $sUnitID,
            'sStudyGroupID' => $sStudyGroupID,
            'sGrade'        => $sGrade,
            'sClassID'      => $sClassID,

            'YearOp'        => $YearOp,
            'SemesterOp'    => $SemesterOp,
            'DayfgOp'       => $DayfgOp,
            'ClassTypeOp'   => $ClassTypeOp,
            'CollegeOp'     => $CollegeOp,
            'UnitOp'        => $UnitOp,
            'StudyGroupOp'  => $StudyGroupOp,
            'GradeOp'       => $GradeOp,
            'ClassOp'       => $ClassOp,
        ));
    }

    public function jump3(Request $request)
    {
        App::setLocale('en');
        $data = array();
        return view('c3::c03250.jump3', array(
            'data' => $data,
        ));
    }

    public function jump4(Request $request)
    {
        App::setLocale('en');
        $data = array();
        return view('c3::c03250.jump4', array(
            'data' => $data,
        ));
    }

    public function jump5(Request $request)
    {
        App::setLocale('en');
        $data = array();
        return view('c3::c03250.jump5', array(
            'data' => $data,
        ));
    }

    // 此畫面的post動作處理
    public function event(Request $request, $id = null)
    {
        // 當前route名稱
        // $viewName = \Request::route()->getName();
        $aRequest = $request->all();
        $event    = $aRequest['event'] ?? null;

        $sReportIP = tACADSysvar::where('var', '=', 'rep_ip')->first()->content;
        $sSchoolNo = 'NTUE';

        // 依照route名稱判定要跑哪一段event處理
        switch ($id) {
            case 'c03250_02':
                $aInput = Common::getInput($request->srh);

                //匯出EXCEL
                if ($event == 'excel') {
                    $aWhere   = array();
                    $aWhere[] = array('a.Year = ?', $aInput['ACADYear']);
                    $aWhere[] = array('a.Semester = ?', $aInput['Semester']);

                    if ($aInput['DayfgID']) {
                        $aWhere[] = array('a.DayfgID = ?', $aInput['DayfgID']);
                    }
                    if ($aInput['ClassTypeID']) {
                        $aWhere[] = array('a.ClassTypeID = ?', $aInput['ClassTypeID']);
                    }
                    if ($aInput['UnitID']) {
                        $aWhere[] = array('a.UnitID = ?', $aInput['UnitID']);
                    }
                    if ($aInput['CollegeID']) {
                        $aWhere[] = array('f.upper = ?', $aInput['CollegeID']);
                    }
                    if ($aInput['StudyGroupID']) {
                        $aWhere[] = array('a.StudyGroupID = ?', $aInput['StudyGroupID']);
                    }
                    if ($aInput['Grade']) {
                        $aWhere[] = array('a.Grade = ?', $aInput['Grade']);
                    }
                    if ($aInput['ClassID']) {
                        $aWhere[] = array('a.ClassID = ?', $aInput['ClassID']);
                    }
                    $data = array();

                    // 匯出欄位
                    $aTitle = array('科系', '應答人數', '填答人數', '填答比例', '科系', '應答人數', '填答比例', '填答人數', '科系', '應答人數', '填答比例', '填答人數');
                    // 檔案名稱
                    $filename = ' 學習策略問卷填答狀況一覽表' . date('Y-m-d H:i:s');
                    $this->setExcel($data, $aTitle, $filename);
                }
                return $this->Jump2($request);
                break;
            case 'NTUE_StuStatisticsRpt':
                $aInput = Common::getInput($request->srh);

                //匯出EXCEL
                if ($event == 'excel') {
                    $aWhere   = array();
                    $aWhere[] = array('a.Year = ?', $aInput['ACADYear']);
                    $aWhere[] = array('a.Semester = ?', $aInput['Semester']);

                    if ($aInput['DayfgID']) {
                        $aWhere[] = array('a.DayfgID = ?', $aInput['DayfgID']);
                    }
                    if ($aInput['ClassTypeID']) {
                        $aWhere[] = array('a.ClassTypeID = ?', $aInput['ClassTypeID']);
                    }

                    $aStdCounts = $this->oStudentRepo->NTUE_StdCount($aWhere);
                    $aUnits     = $this->oStudentRepo->NTUE_StuStatisticsRpt($aWhere);

                    $aSex = array(
                        "M" => "男", "F" => "女",
                    );

                    $aGrade = array(
                        "1", "2", "3", "4", "5", "6",
                    );
                    $aStdCount = array();
                    foreach ($aStdCounts as $kStdCount => $vStdCount) {
                        $uDayfgID     = $vStdCount["DayfgID"];
                        $uClassTypeID = $vStdCount["ClassTypeID"];
                        $uUnitID      = $vStdCount["UnitID"];
                        $iGrade       = $vStdCount["Grade"];
                        $sSex         = $vStdCount["Sex"];
                        $iStdCount    = $vStdCount["StdCount"];
                        // dd($iStdCount);
                        //各年級學生
                        $aStdCount[$uDayfgID][$uClassTypeID][$uUnitID][$iGrade][$sSex] = $iStdCount;
                    }
                    $data = array();
                    foreach ($aUnits as $kUnit => $vUnit) {
                        $uDayfgID     = $vUnit["DayfgID"];
                        $uClassTypeID = $vUnit["ClassTypeID"];
                        $uUnitID      = $vUnit["UnitID"];
                        $iGrade       = 1;

                        $aCount = $aStdCount[$uDayfgID][$uClassTypeID][$uUnitID];

                        $data[$kUnit][] = $vUnit["UnitName"];
                        $data[$kUnit][] = $vUnit["StdCount"];
                        $data[$kUnit][] = $vUnit["MaleStdCount"];
                        $data[$kUnit][] = $vUnit["FemaleStdCount"];
                        foreach ($aGrade as $sGrade) {
                            $data[$kUnit][] = $aCount[$sGrade]['M'] ?? '0';
                            $data[$kUnit][] = $aCount[$sGrade]['F'] ?? '0';
                        }
                    }

                    // dd($data);
                    $this->setExcel_StuStatistics($data, $aUnits);
                }
                return $this->printJump5($request);
                break;

            case 'NTUE_Stu_StdCard':
                $aInput = Common::getInput($request->srh);
                //列印PDF
                if ($event == 'pdf') {
                    $sReportParam = "?report=" . $sNTUE_Stu_StdCard . "&format=PDF&schoolno=" . $sSchoolNo;
                    $sReportParam .= "&Year=" . $aInput['ACADYear'] . "&Semester=" . $aInput['Semester'] . "&DayfgID=" . $aInput['DayfgID']
                        . "&ClassTypeID=" . $aInput['ClassTypeID'] . "&CollegeID=" . $aInput['CollegeID'] . "&UnitID=" . $aInput['UnitID']
                        . "&StudyGroupID=" . $aInput['StudyGroupID'] . "&Grade=" . $aInput['Grade'] . "&ClassID=" . $aInput['ClassID']
                        . "&StudentNo=" . $aInput['StudentNo'];

                    echo $this->setReport(array("report" => $sReportIP . $sReportParam));
                }
                return $this->printJump2($request);
                break;
        }
    }

    /**
     * Excel報表匯出
     * @param array|array $srh_source (F07340_2_RpSource查詢參數)
     * @param array|array $data (學生生活異狀報表資料來源)
     * @return void
     */
    public function setExcel(array $data = array(), $aTitle = array(), $filename = array())
    {
        // if (empty($data)) {
        //     return false;
        // }
        // 設定無timeout
        set_time_limit(0);

        // 匯出欄位
        // $aTitle = array('編號', '班別', '學號', '姓名', '性別', '出生年月日', '生分證字號', '入學方式', '費用別', '學生身分', '原畢業學校', '報到狀況');

        // 產生phpSpreadsheet物件
        $oSpreadSheet = new Spreadsheet();

        // 當前工作頁
        $oCrSheet = $oSpreadSheet->getActiveSheet(0);

        // 寫入Title
        foreach ($aTitle as $title => $titleVal) {
            $oCrSheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($title + 1) . '1', $titleVal);
        }

        // 寫入資料
        foreach ($data as $v_index => $col_value) {
            // 將array索引重整為數字(0,1,2...)
            $col_value = array_values($col_value);
            // 列
            $v_index += 2;
            foreach ($col_value as $h_index => $cell_value) {
                // 位置 $h_index 行 + $v_index 列
                $pos = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($h_index + 1) . $v_index;
                // 置入欄位資料
                $oCrSheet->setCellValue($pos, $cell_value);
                // $oCrSheet->getStyle($pos)->getAlignment()->setWrapText(true);
            }
        }

        // 檔案名稱
        // $filename = ' 新生名單' . date('Y-m-d H:i:s');

        // 儲存檔案
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
        header('Cache-Control: max-age=0');
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($oSpreadSheet, 'Xls');
        $writer->save('php://output');
    }
}
