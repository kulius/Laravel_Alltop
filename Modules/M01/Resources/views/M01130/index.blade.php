@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody = array();
    // $aBody2   = array();
    // $aBody2[] = array("flex" => "auto", "body" => $eZui->setDateBox(array("name" => "SDate_srh", "value" => '')));
    // $aBody2[] = array("flex" => "1", "body" => $eZui->setTextBox(array("value" => '至', "status"=>"view")));
    // $aBody2[] = array("flex" => "auto", "body" => $eZui->setDateBox(array("name" => "EDate_srh", "value" => '')));
    // $sDateHtml = $eZui->setGroup(array('body' => $aBody2));

    // $aBody[] = array("flex" => "6", "head" => __("公告日期範圍"), "body" => $sDateHtml);

    $aBody[] = array("flex" => '3', "body" => $eZui->setTextBox(array("head" => __('模組類別'), "name" => "Menu_srh", "value" =>'', "select" => false)));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody = array();
    $aBody[] = array("flex" => 'auto', "body" => $eZui->setBtnSubmit(array('ex' => 'search', 'value' => 'search')));
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'm01130_view', 'param' => array('add'))));

    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aField = array();
    $aField[] = array('head' => __('中文名稱'), 'name' => 'ChineseName', 'width' => '10%');
    $aField[] = array('head' => __('程式編號'), 'name' => 'CodeNo', 'width' => '20%');
    $aField[] = array('head' => __('目錄編號'), 'name' => 'CatalogNo', 'width' => '20%');
    $aField[] = array('head' => __('icon資料'), 'name' => 'iconData', 'width' => '20%');
    $aField[] = array('head' => __('資訊'), 'name' => 'Information', 'width' => '20%');
    $aField[] = array('head' => __('狀態'), 'name' => 'State', 'width' => '20%');
    $aField[] = array('head' => __('異動日期'), 'name' => 'ChangeDate', 'width' => '20%');
    $aField[] = array('head' => __('異動人員'), 'name' => 'ChangePeople', 'width' => '20%');
    $aField[] = array('head' => __('原因'), 'name' => 'Reason', 'width' => '20%');
    $aField[] = array('head' => __('功能啟用/停用'), 'name' => 'FunctionState', 'width' => '20%');
    $aField[] = array("head" => __("功能"), "name" => "btn", "align" => "right", 'width' => '20%');
    $aData = array();
    foreach ($data as $skData => $svData) {
        $saaID      =trim($svData['aaID']);
        $sChineseName      = trim($svData["ChineseName"]);
        $sCodeNo      = trim($svData["CodeNo"]);
        $sCatalogNo     = trim($svData["CatalogNo"]);
        $siconData     = trim($svData["iconData"]);
        $sInformation = trim($svData["Information"]);
        $sState = trim($svData["State"]);
        $sChangeDate = trim($svData["ChangeDate"]);
        $sChangePeople = trim($svData["ChangePeople"]);
        $sReason = trim($svData["Reason"]);
        $sFunctionState = trim($svData["FunctionState"]);

       $aBtn   = array();
        $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "m01130_view", "param" => array("view", $saaID)));
       $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "m01130_view", "param" => array("edit", $saaID)));

        //隱藏（KEY）
        $aData[$skData]["aaID"] = $saaID;

        //顯示
        $aData[$skData]["ChineseName"]         = $sChineseName;
        $aData[$skData]["CodeNo"]         = $sCodeNo;
        $aData[$skData]["CatalogNo"]        = $sCatalogNo;
        $aData[$skData]["iconData"]        = $siconData;
        $aData[$skData]["Information"]    = $sInformation;
        $aData[$skData]["State"]         = $sState;
$aData[$skData]["ChangeDate"]         = $sChangeDate;
$aData[$skData]["ChangePeople"]         = $sChangePeople;
$aData[$skData]["Reason"]         = $sReason;
$aData[$skData]["FunctionState"]         = $sFunctionState;

        $aData[$skData]["btn"]              = implode("", $aBtn);
    }

    $aSet = array(
    'field' => $aField,
    'data' => $aData,
    "btn" => array("remove"),
    );

    $sHtml .= $eZui->setGridMul($aSet);


    // $aMemo   = array();
    // $aMemo[] = $eZui->setFont(array("text" => _("備註："), "style" => "r"));
    // $aMemo[] = _("1. 是否替換是自動判定");
    // $aMemo[] = _("2. 導師替換擬聘僅對審核通過之資料做修改");
    // $sHtml .= $eZui->setAlert(array("text" => $aMemo, "style" => "y"));



    //echo $sHtml;
    @endphp
        {!! $sHtml !!}
        {!! $eZui->setValidata('main') !!}
</form>
@endsection
