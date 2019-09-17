@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
	@php
    $sHTML = null;

    switch ($status) {
        case 'add':
        case 'edit':
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'a011a0')));
            break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'a011a0')));
            break;
    }

    $sStatus = $status != "add" ? "view" : "";

    $aBody   = array();
    $aOption = array();

    $aBody[] = array("body" => $eZui->setTextBox(array("head" => _("部別"), "name" => "DayfgName", "value" => $data[0]["DayfgName"], "status" => "view", "req" => true)));
    $aBody[] = array("body" => $eZui->setTextBox(array("head" => _("學制"), "name" => "ClassTypeName", "value" => $data[0]["ClassTypeName"], "status" => "view", "req" => true)));
    $aBody[] = array("body" => $eZui->setTextBox(array("head" => _("學院"), "name" => "College", "value" => $data[0]["UnitName"], "status" => "view", "req" => true)));
    $aBody[] = array("body" => $eZui->setTextBox(array("head" => _("系所"), "name" => "UnitName", "value" => $data[0]["UnitName"], "status" => "view", "req" => true)));
    $aBody[] = array("body" => $eZui->setTextBox(array("head" => _("學程"), "name" => "UnitClassTypeName", "value" => $data[0]["UnitClassTypeName"], "status" => "view")));

    $aBody[] = array("body" => $eZui->setComboBox(array("head" => _("組別"), "name" => "StudyGroupID", "value" => $data[0]["StudyGroupID"], "option" => $aOption, "select" => false, "def" => _("請選擇"), "status" => $sStatus)));
    $aBody[] = array("body" => $eZui->setComboBox(array("head" => _("班級代碼"), "name" => "ClassNo", "value" => $data[0]["ClassNo"], "option" => $aOption, "select" => false, "def" => _("請選擇"), "req" => true, "status" => $sStatus)));

    $sHTML .= $eZui->setGroup(array("body" => $aBody));

    $aField   = array();
    $aField[] = array("head" => _("狀態"), "name" => "state", "width" => "10%");
    $aField[] = array("head" => _("年級"), "name" => "Grade", "width" => "10%");
    $aField[] = array("head" => _("班級唯一碼"), "name" => "ClassUniqueNo", "width" => "15%");
    $aField[] = array("head" => _("班級名稱"), "name" => "ClassName", "width" => "15%");
    $aField[] = array("head" => _("班級簡稱"), "name" => "ClassAlias", "width" => "15%");
    $aField[] = array("head" => _("班級英文"), "name" => "ClassENGName", "width" => "15%");

    $aOption   = array();
    $aOption[] = array("value" => '1', "text" => _("使用中"));
    $aOption[] = array("value" => '0', "text" => _("停用"));

    $aEField   = array();
    $aEField[] = array("head" => _("狀態"), "name" => "state", "type" => "combo", "option" => $aOption);
    $aEField[] = array("head" => _("年級"), "name" => "Grade");
    $aEField[] = array("head" => _("班級唯一碼"), "name" => "ClassUniqueNo");
    $aEField[] = array("head" => _("班級名稱"), "name" => "ClassName");
    $aEField[] = array("head" => _("班級簡稱"), "name" => "ClassAlias");
    $aEField[] = array("head" => _("班級英文"), "name" => "ClassENGName");

    $aData = array();

    foreach ($data as $skData => $svData) {
        $sClassID       = trim($svData["ClassID"]);
        $sState         = trim($svData["state"]);
        $sGrade         = trim($svData["Grade"]);
        $sClassUniqueNo = trim($svData["ClassUniqueNo"]);
        $sClassName     = trim($svData["ClassName"]);
        $sClassAlias    = trim($svData["ClassAlias"]);
        $sClassENGName  = trim($svData["ClassENGName"]);

        //隱藏（KEY）
        $aData[$skData]["ClassID"] = $sClassID;

        //顯示
        $aData[$skData]["state"]         = $sState;
        $aData[$skData]["Grade"]         = $sGrade;
        $aData[$skData]["ClassUniqueNo"] = $sClassUniqueNo;
        $aData[$skData]["ClassName"]     = $sClassName;
        $aData[$skData]["ClassAlias"]    = $sClassAlias;
        $aData[$skData]["ClassENGName"]  = $sClassENGName;

    }

    $aSet = array(
        "field"  => $aField,
        "efield" => $aEField,
        "data"   => $aData,
        "btn"    => array("remove", "add", "save"),
    );

    $sHTML .= $eZui->setEGrid($aSet);

	@endphp
    {!! $sHTML !!}
    {!! $eZui->setValidata('main') !!}
    </form>
@endsection
