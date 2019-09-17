@inject('eZui', 'App\Alltop\BaseView')
@extends('layouts.frame_modal')

@section('content')
<form action="" name="StuSel" method="POST">
    {{ csrf_field() }}

@php
$sHtml = null;

$aForm = array();

// $sHtml .= $eZui->setHideBox(array('name' => 'StuSel'));

$aBody = array();
$aBody[] = array("flex" => "2", "body" => $eZui->setComboBox(array("head" => __("學年"), "name" => "srh[ACADYear]", "value" => $sYear, "option" => $YearOp, "select" => false, 'attr' => array('onchange="StuSel.submit();"'))));
$aBody[] = array("flex" => "2", "body" => $eZui->setComboBox(array("head" => __("學期"), "name" => "srh[Semester]", "value" => $sSem, "option" => $SemOp, "select" => false, 'attr' => array('onchange="StuSel.submit();"'))));
$aBody[] = array("flex" => "2", "body" => $eZui->setComboBox(array("head" => __("部別"), "name" => "srh[DayfgID]", "value" => $sDayfgID, "option" => $DfgOp, 'attr' => array('onchange="StuSel.submit();"'))));
$aBody[] = array("flex" => "4", "body" => $eZui->setComboBox(array("head" => __("學制"), "name" => "srh[ClassTypeID]", "value" => $sClassTypeID, "option" => $ClassTypeOp, 'attr' => array('onchange="StuSel.submit();"'))));
$aBody[] = array("flex" => "2", "body" => $eZui->setComboBox(array("head" => __("學院"), "name" => "srh[CollegeID]", "value" => $sCollegeID, "option" => $CollegeOp, 'attr' => array('onchange="StuSel.submit();"'))));
$sHtml .= $eZui->setGroup(array('body' => $aBody));

$aBody   = array();
$aBody[] = array("flex" => "3", "body" => $eZui->setComboBox(array("head" => __("系所"), "name" => "srh[UnitID]", "value" => $sUnitID, "option" => $UnitOp, 'attr' => array('onchange="StuSel.submit();"'))));
$aBody[] = array("flex" => "3", "body" => $eZui->setComboBox(array("head" => __("組別"), "name" => "srh[GroupID]", "value" => $sGroupID, "option" => $GroupOp, 'attr' => array('onchange="StuSel.submit();"'))));
$aBody[] = array("flex" => "3", "body" => $eZui->setComboBox(array("head" => __("年級"), "name" => "srh[Grade]", "value" => $sGrade, "option" => $GradeOp, 'attr' => array('onchange="StuSel.submit();"'))));
$aBody[] = array("flex" => "3", "body" => $eZui->setComboBox(array("head" => __("班級"), "name" => "srh[ClassID]", "value" => $sClassID, "option" => $ClassOp, 'attr' => array('onchange="StuSel.submit();"'))));

$sHtml .= $eZui->setGroup(array("body" => $aBody));


$aField   = array();
$aField[] = array("head" => __("學號"), "name" => "StudentNo", "width" => "20%");
$aField[] = array("head" => __("姓名"), "name" => "ChtName");

$aData = array();

foreach ($aModel as $skData => $svData) {
    //隱藏（KEY）
    $aData[$skData]["StudentID"] = trim($svData["StudentID"]);

    //顯示
    $aData[$skData]["StudentNo"] = trim($svData["StudentNo"]);
    $aData[$skData]["ChtName"] = trim($svData["ChtName"]);
}

$aSet = array(
    "id" => 'StuSel',
    "field" => $aField,
    "data"  => $aData,
    "btn"   => array("select"),
);

$sHtml .= $eZui->setGridSGL($aSet);

// $aBody = array();
// $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'search', 'param' => array('srh'))));
// $sHtml .= $eZui->setGroup(array("body" => $aBody));

echo $sHtml;

@endphp

</form>
@endsection
