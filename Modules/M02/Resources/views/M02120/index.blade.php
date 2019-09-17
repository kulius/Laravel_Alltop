@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHtml = null;
    // $aBody2   = array();
    // $aBody2[] = array("flex" => "auto", "body" => $eZui->setDateBox(array("name" => "SDate_srh", "value" => '')));
    // $aBody2[] = array("flex" => "1", "body" => $eZui->setTextBox(array("value" => '至', "status"=>"view")));
    // $aBody2[] = array("flex" => "auto", "body" => $eZui->setDateBox(array("name" => "EDate_srh", "value" => '')));
    // $sDateHtml = $eZui->setGroup(array('body' => $aBody2));

    // $aBody[] = array("flex" => "6", "head" => __("公告日期範圍"), "body" => $sDateHtml);


    $aBody = array();
    // $aBody[] = array("flex" => 'auto', "body" => $eZui->setBtnSubmit(array('ex' => 'search', 'value' => 'search')));
    // $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'm02120_view', 'param' => array('add'))));
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'm02120_view', 'param' => array('add'))));

    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aField = array();
    $aField[] = array('head' => __('異動日期'), 'name' => 'ChangeDate', 'width' => '20%');
    $aField[] = array('head' => __('異動時間'), 'name' => 'ChangeTime', 'width' => '20%');
    $aField[] = array('head' => __('IP'), 'name' => 'IP', 'width' => '20%');
    $aField[] = array('head' => __('異動人'), 'name' => 'ChangePeople', 'width' => '20%');
    //$aField[] = array("head" => __("功能"), "name" => "btn", "align" => "right", 'width' => '20%');
    $aData = array();
    foreach ($data as $skData => $svData) {
        $saaID      =trim($svData['aaID']);
        $sChangeDate = trim($svData["ChangeDate"]);
        $sChangeTime = trim($svData["ChangeTime"]);
        $sIP = trim($svData["IP"]);
        $sChangePeople = trim($svData["ChangePeople"]);

       $aBtn   = array();
        $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "m02120_view", "param" => array("view", $saaID)));
       $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "m02120_view", "param" => array("edit", $saaID)));

        //隱藏（KEY）
        $aData[$skData]["aaID"] = $saaID;

        //顯示
        $aData[$skData]["ChangeDate"]         = $sChangeDate;
        $aData[$skData]["ChangeTime"]         = $sChangeTime;
        $aData[$skData]["IP"]         = $sIP;
        $aData[$skData]["ChangePeople"]         = $sChangePeople;

        //$aData[$skData]["btn"]              = implode("", $aBtn);
    }

    $aSet = array(
    'field' => $aField,
    'data' => $aData,
    //"btn" => array("remove"),
    );

    $sHtml .= $eZui->setGrid($aSet);


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
