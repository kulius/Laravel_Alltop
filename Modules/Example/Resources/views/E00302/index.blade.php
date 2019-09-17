@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form method='POST' name="main">
{{ csrf_field() }}
@php
$sHtml = null;

$aBody   = array();
$aBody[] = array("flex" => "2", "body" => $eZui->setComboBox(array("head" => __("學年"), "name" => "srh[ACADYear]", "value" => $sYear, "option" => $YearOp, "select" => true)));
$aBody[] = array("flex" => "2", "body" => $eZui->setComboBox(array("head" => __("學期"), "name" => "srh[Semester]", "value" => $sSem, "option" => $SemOp, "select" => true)));
$aBody[] = array("flex" => "2", "body" => $eZui->setComboBox(array("head" => __("部別"), "name" => "srh[DayfgID]", "value" => $sDayfgID, "option" => $DfgOp, "select" => true, 'attr' => array('onchange="main.submit();"'))));
$aBody[] = array("flex" => "2", "body" => $eZui->setComboBox(array("head" => __("學制"), "name" => "srh[ClassTypeID]", "value" => $sClassTypeID, "option" => $ClassTypeOp, "select" => true, 'attr' => array('onchange="main.submit();"'))));
$aBody[] = array("flex" => "2", "body" => $eZui->setComboBox(array("head" => __("學院"), "name" => "srh[CollegeID]", "value" => $sCollegeID, "option" => $CollegeOp, "select" => true, 'attr' => array('onchange="main.submit();"'))));
$aBody[] = array("flex" => "2", "body" => $eZui->setComboBox(array("head" => __("系所"), "name" => "srh[UnitID]", "value" => $sUnitID, "option" => $UnitOp, "select" => true, 'attr' => array('onchange="main.submit();"'))));
$sHtml .= $eZui->setGroup(array('body' => $aBody));

$aBody   = array();
$aBody[] = array("flex" => "2", "body" => $eZui->setComboBox(array("head" => __("組別"), "name" => "srh[GroupID]", "value" => $sGroupID, "option" => $GroupOp, "select" => true, 'attr' => array('onchange="main.submit();"'))));
$aBody[] = array("flex" => "2", "body" => $eZui->setComboBox(array("head" => __("年級"), "name" => "srh[Grade]", "value" => $sGrade, "option" => $GradeOp, "select" => true, 'attr' => array('onchange="main.submit();"'))));
$aBody[] = array("flex" => "2", "body" => $eZui->setComboBox(array("head" => __("班級"), "name" => "srh[ClassID]", "value" => $sClassID, "option" => $ClassOp, "select" => true, 'attr' => array('onchange="main.submit();"'))));
$aBody[] = array("flex" => "2", "body" => $eZui->setTextBox(array("head" => __("學號"), "name" => "srh[StudentNo]", "value" => $sStudentNo)));
$aBody[] = array("flex" => "2", "body" => $eZui->setTextBox(array("head" => __("姓名"), "name" => "srh[ChtName]", "value" => $sChtName)));
$aBody[] = array("flex" => "2", "body" => $eZui->setComboBox(array("head" => __("簽核狀態"), "name" => "srh[SingStatus]", "value" => $sStatus, "option" => $SingStatusOp, "select" => true)));
$sHtml .= $eZui->setGroup(array('body' => $aBody));

$aBody   = array();
$aBody[] = array("flex" => "4", "body" => $eZui->setDateBox(array("name" => "srh[LeaveDateBeg]", "value" => $sLeaveDateBeg)));
$aBody[] = array("flex" => "4", "body" => $eZui->setDateBox(array("name" => "srh[LeaveDateEnd]", "value" => $sLeaveDateEnd)));
$sDateHtml = $eZui->setGroup(array('body' => $aBody));

$aBody   = array();
$aBody[] = array("flex" => "6", "head" => __("起訖時間"), "body" => $sDateHtml);
$sHtml .= $eZui->setGroup(array('body' => $aBody));

$aBody   = array();
$aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'search', 'value' => 'search')));
$aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'e00302_view', 'param' => array('add'))));
$sHtml .= $eZui->setGroup(array('body' => $aBody));

$aField   = array();
$aField[] = array("head" => __("學號"), "name" => "StudentNo", "width" => "20%");
$aField[] = array("head" => __("姓名"), "name" => "ChtName", "width" => "20%");
$aField[] = array("head" => __("班級名稱"), "name" => "ClassName", "width" => "20%");
$aField[] = array("head" => __("假別"), "name" => "LeaveKindName", "width" => "20%");
$aField[] = array("head" => __("假由"), "name" => "LeaveReason", "width" => "20%");
$aField[] = array("head" => __("請假日期"), "name" => "AbsentSEDate", "width" => "20%");
$aField[] = array("head" => __("節數"), "name" => "SectionSeqCount", "width" => "20%");
$aField[] = array("head" => __("簽核狀態"), "name" => "status", "width" => "20%");
$aField[] = array("head" => __("簽核功能"), "name" => "signOption", "width" => "20%");
$aField[] = array("head" => __("功能"), "name" => "btn", "align" => "right");

$aData = array();
$SingStatusText = array('1' => '未送出', '2' => '流程中', '3' => '退回', '4' => '不通過', '5' => '已通過');
foreach ($data as $skData => $value) {
    //隱藏（KEY）
    $aData[$skData]["StdAbsentID"] = $value["StdAbsentID"];
    $aData[$skData]["StudentNo"] = $value["StudentNo"];
    $aData[$skData]["ChtName"] = $value["ChtName"];
    $aData[$skData]["ClassName"] = $value["ClassName"];
    $aData[$skData]["LeaveKindName"] = $value["LeaveKindName"];
    $aData[$skData]["LeaveReason"] = $value["LeaveReason"];
    $aData[$skData]["AbsentSEDate"] = $value["AbsentSEDate"];
    $aData[$skData]["SectionSeqCount"] = $value["SectionSeqCount"];
    $aData[$skData]["status"] = $SingStatusText[$value["status"]];
    $aData[$skData]["signOption"] = '';

    $aBtn   = array();
    $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "e00302_view", "param" => array("view", $value["StdAbsentID"])));
    $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "e00302_view", "param" => array("edit", $value["StdAbsentID"])));

    $aData[$skData]["btn"] = implode("", $aBtn);
}

$aSet = array(
    'field' => $aField,
    'data'  => $aData,
    'btn'   => array('remove'),
);

$sHtml .= $eZui->setGridMUL($aSet);

echo $sHtml;

@endphp
</form>
@endsection
