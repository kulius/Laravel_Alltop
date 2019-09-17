<?php

namespace Modules\Example\Http\Controllers;

use App;
use App\Alltop\Combo;
use App\Alltop\Common;
use App\Database\ACAD\tEducationMinistryDataGroup\Model\tEducationMinistryDataGroup;
use App\Database\ACAD\tEducationMinistryData\Model\tEducationMinistryData;
use App\Database\ACAD\tPara\Model\tPara;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

/*
 */
class A02150ControllerExample extends Controller
{
    private $oCombo;

    public function __construct(Combo $oCombo)
    {
        App::setLocale('en');
        $this->oCombo = $oCombo;
        $this->oCombo->ELCClass_combo();
    }

    public function index1(Request $request)
    {

        //停覆用
        if ($request->event == 'stop') {
            //   dd($request->all());
            $stop_id = json_decode($request->tb_sel, true);
            if ($stop_id) {
                $aID = array_map(function ($item) {return $item['DataID'];}, $stop_id);
                foreach ($aID as $k => $sID) {
                    $oData = tEducationMinistryData::find($sID);
                    if ($oData->state == '1') {
                        $oData->state = '0';
                    } else {
                        $oData->state = '1';
                    }
                    $result = $oData->save();
                }
                if ($result) {
                    session()->flash('sweet', array('success', '資料更新成功！'));
                } else {
                    session()->flash('sweet', array('error', '資料更新失敗！'));
                }
            }
        }

        $sEduDepID_srh    = $request->get('EducationDepartment')[0];
        $sDataGroupID_srh = $request->get('DataGroupID')[0];
        $aWhere           = array();
        if ($sDataGroupID_srh) {
            $aWhere[] = array('tEducationMinistryDataGroup.DataGroupID', $sDataGroupID_srh);
        }
        //$data = tEducationMinistryData::with('ministryGroup')->where($aWhere)->get();
        if ($sEduDepID_srh) {
            $aWhere[] = array('EducationDepartment', $sEduDepID_srh);
        }
        $data = DB::connection('ACAD')->table('tEducationMinistryData')
                                      ->join('tEducationMinistryDataGroup', 'tEducationMinistryData.DataGroupID', 'tEducationMinistryDataGroup.DataGroupID')
                                      ->where($aWhere)->get();
        // dd($data);
        //報部單位下拉
        $aWhere   = array();
        $aWhere[] = array('tPara.parano', 'EducationDepartment');

        $aEducationDepartment = tPara::where($aWhere)->select('paracodeno as value', 'paracodename as text')
                                                     ->get()->toArray();

        //教育部群組下拉
        $aEducationMinistryDataGroup = tEducationMinistryDataGroup::select('DataGroupID as value', 'GroupName as text')
            ->get()->toArray();

        return view('example::a02150.index1', array(
            'data'                        => $data,
            'aEducationDepartment'        => $aEducationDepartment,
            'aEducationMinistryDataGroup' => $aEducationMinistryDataGroup,
        ));
    }

    public function view1(Request $request, $status = null, $id = null)
    {
        if ($status == 'view') {
            session()->put('status', 'view');
        }

        $aData       = tEducationMinistryData::find($id);
        $aGroupCombo = tEducationMinistryDataGroup::select('DataGroupID as value', 'GroupName as text')
            ->get()->toArray();
        return view('example::a02150.view1', array(
            'data'        => $aData,
            'status'      => $status,
            'aGroupCombo' => $aGroupCombo,
            'sGroupID'    => $aData['DataGroupID'],
        ));
    }

    public function view1_post(Request $request, $status = null, $id = null)
    {
        $aInput = Common::getInput($request->all());
        // dd($aInput);
        if ($request->event == 'save') {
            //array('sss' => 'asd', 'Data'=> 'asd', 'updateID' => 'asd', '')
            $result = tEducationMinistryData::updateOrCreate(array('DataID' => $id), $aInput);
            if ($status == 'add') {
                if ($result) {
                    session()->flash('sweet', array('success', '資料新增成功！'));
                } else {
                    session()->flash('sweet', array('error', '資料新增失敗！'));
                }
            } else if ($status == 'edit') {
                if ($result) {
                    session()->flash('sweet', array('success', '資料更新成功！'));
                } else {
                    session()->flash('sweet', array('error', '資料更新失敗！'));
                }
            }
        }

        return redirect()->route('e00304_view1', array('edit', $result->getKey()));
    }

    //TODO::教育部代碼 Form 驗證
    //return true 代表驗證成功 return false
    public function validateData($aData = null)
    {
        //現在都return true 之後再寫
        return true;

        //驗證規則請參考 https://laravel.com/docs/5.8/validation#available-validation-rules
        //搜尋 Available Validation Rules
        $rules = array(
            'Html的name' => 'numeric|min:1|max:10', //數字且範圍1~10
            'Html的name' => 'required',             //必填欄位
            'Html的name' => 'required|email',       //必填且是email格式
            'Html的name' => '',
            'Html的name' => '驗證規則',
            'Html的name' => '驗證規則',
        );
        $messages = array(
            'numeric'  => ':attribute 欄資料不是數字', //:attribute => Html 的 name
            'required' => ':attribute 欄資料為必填',
            'email'    => ':attribute 欄資料不是email',
        );

        //傳入的aData必須是array() 且 要與 $rules 陣列對應 key value
        // $rules = array('name' => 'required'), $aData = array('name' => 'Neo');
        $oValidator = Validator::make($aData, $rules, $messages);
        if ($oValidator->fails()) {
            //失敗看要做什麼，取出失敗的訊息
            $customMsg = $oValidator->messages();
            return false;
        }
        return true;
    }

    public function index2(Request $request)
    {
        $sEduDeptID_srh = $request->get('EducationDepartment')[0];
        $sWhere         = array();

        if ($sEduDeptID_srh) {
            $sWhere[] = array('EducationDepartment', $sEduDeptID_srh);
        }
        $data = tEducationMinistryDataGroup::where($sWhere)->get();

        //報部單位下拉
        $aWhere   = array();
        $aWhere[] = array('parano', 'EducationDepartment');

        $aEducationDepartment = tPara::where($aWhere)->select('paracodeno as value', 'paracodename as text')
                                                     ->get()->toArray();

        return view('example::a02150.index2', array(
            'data'                 => $data,
            'aEducationDepartment' => $aEducationDepartment,

        ));
    }

    public function view2(Request $request, $status = null, $id = null)
    {
        //報部單位下拉
        $aWhere   = array();
        $aWhere[] = array('parano', 'EducationDepartment');

        $aEducationDepartment = tPara::where($aWhere)->select('paracodeno as value', 'paracodename as text')
                                                     ->get()->toArray();

        if ($status == 'add') {
            $data         = null;
            $sDataGroupID = $request->get('DataGroupID');
        } else {
            $data         = tEducationMinistryDataGroup::find($id);
            $sDataGroupID = $data['DataGroupID'];
        }
        $data = tEducationMinistryDataGroup::find($sDataGroupID);

        return view('example::a02150.view2', array(
            'data'                 => $data,
            'status'               => $status,
            'aEducationDepartment' => $aEducationDepartment,
        ));
    }

    public function view2_post(Request $request, $status = null, $id = null)
    {

        $aData = Common::getInput($request->all());

        if ($request->event == 'save') {
            $result = tEducationMinistryDataGroup::updateOrCreate(array('DataGroupID' => $id), $aData);
            if ($result) {
                Session::flash('sweet', array('success', '資料儲存成功！'));
            } else {
                Session::flash('sweet', array('error', '資料儲存失敗！'));
            }
        }
        return redirect()->route('e00304_view2', array('edit', $result->DataGroupID));
    }
}
