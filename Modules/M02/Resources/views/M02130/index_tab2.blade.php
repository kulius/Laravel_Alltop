@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='judge' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody = array();
    $aBody[] = array("flex" => '3', "body" => $eZui->setComboBox(array("head" => __("單位"), "name" => "BelongMenu_srh", "value" =>'' , "option" => '', "select" => false)));
    $aBody[] = array("flex" => '3', "body" => $eZui->setTextBox(array("head" => __("授權對象"), "name" => "Function1_srh", "value" =>'' , "select" => false)));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));



    $aBody = array();
    $aBody[] = array("flex" => 'auto', "body" => $eZui->setBtnSubmit(array('ex' => 'search', 'value' => 'search')));
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'm02130_tab2_view', 'param' => array('add'))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));


    $aField = array();
    $aField[] = array('head' => __('部別'), 'name' => 'DayfgID', 'width' => '10%');
    $aField[] = array('head' => __('學制'), 'name' => 'ClassTypeID', 'width' => '20%');
    $aField[] = array('head' => __('學院'), 'name' => 'CollegeID', 'width' => '20%');
    $aField[] = array('head' => __('系所'), 'name' => 'UnitID', 'width' => '20%');
    $aField[] = array('head' => __('授權對象'), 'name' => 'AuzObject', 'width' => '20%');
    $aField[] = array("head" => __("功能"), "name" => "btn", "align" => "right", 'width' => '20%');

    $aData = array();
    foreach ($data as $skData => $svData) {
        $saaID      =trim($svData['aaID']);
        $sDayfgID      =trim($svData['DayfgID']);
        $sClassTypeID      = trim($svData["ClassTypeID"]);
        $sCollegeID      = trim($svData["CollegeID"]);
        $sUnitID     = trim($svData["UnitID"]);
        $sAuzObject     = trim($svData["AuzObject"]);
        $aBtn   = array();
        $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "m02130_tab2_view", "param" => array("view", $saaID)));
        $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "m02130_tab2_view", "param" => array("edit", $saaID)));

        //隱藏（KEY）
       $aData[$skData]["aaID"] = $saaID;

        //顯示
        $aData[$skData]["DayfgID"]         = $sDayfgID;
        $aData[$skData]["ClassTypeID"]         = $sClassTypeID;
        $aData[$skData]["CollegeID"]        = $sCollegeID;
        $aData[$skData]["UnitID"]    = $sUnitID;
        $aData[$skData]["AuzObject"]    = $sAuzObject;

        $aData[$skData]["btn"]                  = implode("", $aBtn);
    }


    $aSet = array(
        'field' => $aField,
        'data' => $aData,
        "btn" => array("remove"),
    );

    $sHtml .= $eZui->setGridMUL($aSet);

    $aParams = array(
        'aTabInfo' => array(
            'm02130' => array('param' => "", 'title'=>'密碼還原作業'),
            'm02130_tab2' => array('param' => "", 'title'=>'授權設定', 'view' => $sHtml, 'current' => 'active'),
            )
    );
    $sHtml = $eZui->setTab($aParams);

    // $aMemo   = array();
    // $aMemo[] = $eZui->setFont(array("text" => _("備註："), "style" => "r"));
    // $aMemo[] = _("1. 是否替換是自動判定");
    // $aMemo[] = _("2. 導師替換擬聘僅對審核通過之資料做修改");
    // $sHtml .= $eZui->setAlert(array("text" => $aMemo, "style" => "y"));


    //echo $sHtml;
    @endphp
            {!! $sHtml !!}
            {!! $eZui->setValidata('judge') !!}
</form>
@endsection
