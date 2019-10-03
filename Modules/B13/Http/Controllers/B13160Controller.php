<?php

namespace Modules\B13\Http\Controllers;

use App;
use App\Alltop\Combo;
use App\Alltop\Common;
use App\Database\ACAD\ACADSysvar\Model\tACADSysvar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class B13160Controller extends Controller
{

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
        return view('b13::B13160.index', array(
            'data'    => $data,
            //Op
            'aYearOp' => $aYearOp,
            'aSemOp'  => $aSemOp,

            //Value
            'sYear'   => $sYear,
            'sSem'    => $sSem,

        ));
    }

    /**
     * 頁籤一
     */
    public function tab1(Request $request)
    {
        App::setLocale('en');
//學年
        $aYear = $this->combo->Year_combo();
//學期
        $aSemester = $this->combo->Semester_combo();
//部別
        $aDayfg = $this->combo->Dayfg_combo();
//學制
        $aClassType = $this->combo->ClassType_combo();
//學院
        $aCollege = $this->combo->College_combo();
//系所
        $aUnit = $this->combo->Unit_combo();
//組別
        $aUnitClass = $this->combo->UnitClassType_combo();
//年級
        $aGrade = $this->combo->Grade_combo();
//班級
        $aClass = $this->combo->Class_combo();
        $request->flash();
        $data = array(
            array("Result" => "108", "OpenAndClose" => "2019/07/29 08:00~2019/09/30 23:59"),

        );
        return view('b13::B13160.index_tab1', array(
            'data'       => $data,
            'aYear'      => $aYear,
            'aSemester'  => $aSemester,
            'aDayfg'     => $aDayfg,
            'aClassType' => $aClassType,
            'aCollege'   => $aCollege,
            'aUnit'      => $aUnit,
            'aUnitClass' => $aUnitClass,
            'aGrade'     => $aGrade,
            'aClass'     => $aClass,
        ));
    }

    /**
     * 頁籤一
     */
    public function tab2(Request $request)
    {
        App::setLocale('en');
//學年
        $aYear = $this->combo->Year_combo();
//學期
        $aSemester = $this->combo->Semester_combo();
//部別
        $aDayfg = $this->combo->Dayfg_combo();
//學制
        $aClassType = $this->combo->ClassType_combo();
//學院
        $aCollege = $this->combo->College_combo();
//系所
        $aUnit = $this->combo->Unit_combo();
//組別
        $aUnitClass = $this->combo->UnitClassType_combo();
//年級
        $aGrade = $this->combo->Grade_combo();
//班級
        $aClass = $this->combo->Class_combo();
        $request->flash();
        $data = array(
            array("Result" => "108", "OpenAndClose" => "2019/07/29 08:00~2019/09/30 23:59"),

        );
        return view('b13::B13160.index_tab2', array(
            'data'       => $data,
            'aYear'      => $aYear,
            'aSemester'  => $aSemester,
            'aDayfg'     => $aDayfg,
            'aClassType' => $aClassType,
            'aCollege'   => $aCollege,
            'aUnit'      => $aUnit,
            'aUnitClass' => $aUnitClass,
            'aGrade'     => $aGrade,
            'aClass'     => $aClass,
        ));
    }

    /**
     * 明細頁
     */
    public function view(Request $request, $status = null, $id = null)
    {

        //學年
        $aYear = $this->combo->Year_combo();
        //學期
        $aSemester = $this->combo->Semester_combo();
        //部別
        $aDayfg = $this->combo->Dayfg_combo();
        if ($status == 'view') {
            session()->flash('status', 'view');
        }

        $data = array(
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
        );

        return view('b13::B13160.view', array(
            'data'      => $data,
            'status'    => $status,
            'id'        => $id,
            'aYear'     => $aYear,
            'aSemester' => $aSemester,
            'aDayfg'    => $aDayfg,
        ));
    }

/**
 * 明細頁0
 */
    public function tab1_view(Request $request, $status = null, $id = null)
    {
        //學年
        $aYear = $this->combo->Year_combo();
        //學期
        $aSemester = $this->combo->Semester_combo();
        //部別
        $aDayfg = $this->combo->Dayfg_combo();
        if ($status == 'view') {
            session()->flash('status', 'view');
        }

        $data = array(
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
        );

        return view('b13::B13160.tab1_view', array(
            'data'      => $data,
            'status'    => $status,
            'id'        => $id,
            'aYear'     => $aYear,
            'aSemester' => $aSemester,
            'aDayfg'    => $aDayfg,
        ));
    }

    /**
     * 明細頁0
     */
    public function tab2_view(Request $request, $status = null, $id = null)
    {
        //學年
        $aYear = $this->combo->Year_combo();
        //學期
        $aSemester = $this->combo->Semester_combo();
        //部別
        $aDayfg = $this->combo->Dayfg_combo();
        if ($status == 'view') {
            session()->flash('status', 'view');
        }

        $data = array(
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
            array("Year" => "108", "Semester" => "1", "MeetingKind" => "例行會議", "MeetingName" => "例行會議1", "MeetingDate" => "2019/08/30 15:30", "Subject" => "例行會議公告", "Content" => "例行會議內容"),
        );

        return view('b13::B13160.tab2_view', array(
            'data'      => $data,
            'status'    => $status,
            'id'        => $id,
            'aYear'     => $aYear,
            'aSemester' => $aSemester,
            'aDayfg'    => $aDayfg,
        ));
    }

    /**
     * 儲存
     */
    public function save(Request $request, $status = null, $id = null)
    {
        $event = $request->get('event');
        $data  = $request->all();

        if ($status == 'add') {
            $data['ApplyID']   = Session::get('user_id');
            $data['ApplyDate'] = date("Y-m-d H:i:s");
        }

        //異動者ID、異動時間
        $data['UpdateID']   = Session::get('user_id');
        $data['UpdateDate'] = date("Y-m-d H:i:s");

        if ($event === 'save') {
            if ($result) {
                Session::flash('sweet', array('success', '儲存執行成功！'));
                $model = 'edit';
            } else {
                Session::flash('sweet', array('error', '儲存執行失敗！'));
                if ($status != 'edit') {
                    $model = 'add';
                } else {
                    $model = $status;
                }
            }
            return redirect()->route('B13160_view', array($model));
        } else {
            return view('b13::B13160.view', array(
                'data'   => $data,
                'status' => $status,
            ));
        }
    }
}
