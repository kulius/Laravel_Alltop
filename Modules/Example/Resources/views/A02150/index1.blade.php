@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form method='POST' id="index1">
{{ csrf_field() }}
@php
$sHtml = null;

$aBody   = array();
$aBody[] = array("flex" => "4", "body" => $eZui->setComboBox(array("head" => __("報部單位"),
 "name" => "EducationDepartment", "value" => $_POST['EducationDepartment'] ?? null,
  "option" => $aEducationDepartment, "select" => false, "def" => '-')));

$aBody[] = array("flex" => "4", "body" => $eZui->setComboBox(array("head" => __("教育部群組"),
 "name" => "DataGroupID", "value" => $_POST['DataGroupID'] ?? null,
  "option" => $aEducationMinistryDataGroup, "select" => false, "def" => '-')));

$sHtml .= $eZui->setGroup(array('body' => $aBody));

$aBody   = array();
$aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'search', 'value' => 'search')));
$aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'e00304_view1',
 'param' => array('add'))));

$sHtml .= $eZui->setGroup(array('body' => $aBody));

$aField   = array();
$aField[] = array("head" => _("教育部代碼群組"), "name" => "DataGroupID", "width" => "25%");
$aField[] = array("head" => _("教育部代碼名稱"), "name" => "Name", "width" => "25%");
$aField[] = array("head" => _("教育部代碼"), "name" => "Code", "width" => "25%");
$aField[] = array("head" => _("狀態"), "name" => "state", "width" => "15%");
$aField[] = array("head" => _("功能"), "name" => "btn", "align" => "right");

$aData = array();
foreach ($data as $skData => $svData) {
    //隱藏（KEY）
    $aData[$skData]["DataID"]         = trim($svData["DataID"]);

    //顯示
    $aData[$skData]["DataGroupID"]    = trim($svData['GroupName']);
    $aData[$skData]["Name"]           = trim($svData["Name"]);
    $aData[$skData]["Code"]           = trim($svData["Code"]);
    $aData[$skData]["state"]          = trim($svData["state"]);

    if(trim($svData['state']) == '1'){
        $state = '使用中';
    }else if (trim($svData['state']) == '0'){
        $state = '<span style="color: red;">停用</span>';
    }
    $aData[$skData]["state"]         = $state;

    $aBtn   = array();
    $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "e00304_view1", "param" => array("view", trim($svData["DataID"]))));
    $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "e00304_view1", "param" => array("edit", trim($svData["DataID"]))));
    $aData[$skData]["btn"] = implode("", $aBtn);
}

$aSet = array(
    'field' => $aField,
    'data'  => $aData,
    'btn'   => array('stop'),
);

$sHtml .= $eZui->setGridMUL($aSet);

$aParams =  array(
                'aTabInfo' => array(
                    'e00304' => array('title'=>'教育部代碼', 'view' => $sHtml, 'current' => 'active'),
                    'e00304_index2' => array('title'=>'教育部代碼群組'),
                )
            );
$sHtml = $eZui->setTab($aParams);

echo $sHtml;

@endphp
</form>
@endsection
