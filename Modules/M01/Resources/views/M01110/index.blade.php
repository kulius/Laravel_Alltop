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

    $aBody[] = array("flex" => '3', "body" => $eZui->setTextBox(array("head" => __("主選單編號/主選單名稱"), "name" => "Menu_srh", "value" =>'', "select" => false)));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody = array();
    $aBody[] = array("flex" => 'auto', "body" => $eZui->setBtnSubmit(array('ex' => 'search', 'value' => 'search')));
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'm01110_view', 'param' => array('add'))));

    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aField = array();
    $aField[] = array('head' => __('主選單編號'), 'name' => 'MenuNo', 'width' => '10%');
    $aField[] = array('head' => __('主選單名稱'), 'name' => 'MenuName', 'width' => '20%');
    $aField[] = array('head' => __('所屬專案'), 'name' => 'BelongProject', 'width' => '20%');
    $aField[] = array('head' => __('選單排序'), 'name' => 'ListSort', 'width' => '20%');
    $aField[] = array('head' => __('是否顯示'), 'name' => 'IfShow', 'width' => '20%');
    $aField[] = array('head' => __('異動日期'), 'name' => 'ChangeDate', 'width' => '20%');
    $aField[] = array("head" => __("功能"), "name" => "btn", "align" => "right", 'width' => '20%');
    $aData = array();
    foreach ($data as $skData => $svData) {
        $saaID      =trim($svData['aaID']);
        $sMenuNo      = trim($svData["MenuNo"]);
        $sMenuName      = trim($svData["MenuName"]);
        $sBelongProject     = trim($svData["BelongProject"]);
        $sListSort     = trim($svData["ListSort"]);
        $sIfShow = trim($svData["IfShow"]);
        $sChangeDate = trim($svData["ChangeDate"]);

       $aBtn   = array();
        $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "m01110_view", "param" => array("view", $saaID)));
       $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "m01110_view", "param" => array("edit", $saaID)));

        //隱藏（KEY）
        $aData[$skData]["aaID"] = $saaID;

        //顯示
        $aData[$skData]["MenuNo"]         = $sMenuNo;
        $aData[$skData]["MenuName"]         = $sMenuName;
        $aData[$skData]["BelongProject"]        = $sBelongProject;
        $aData[$skData]["ListSort"]        = $sListSort;
        $aData[$skData]["IfShow"]    = $sIfShow;
        $aData[$skData]["ChangeDate"]         = $sChangeDate;

        $aData[$skData]["btn"]              = implode("", $aBtn);
    }

    $aSet = array(
    'field' => $aField,
    'data' => $aData,
    "btn" => array("remove"),
    );

    $sHtml .= $eZui->setGridMul($aSet);

    $aParams = array(
    'aTabInfo' => array(
    'm01110' => array('param' => "", 'title'=>'主選單', 'view' => $sHtml, 'current' => 'active'),
    'm01110_tab2' => array('param' => "", 'title'=>'子選單', 'show' => 'true'),
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
        {!! $eZui->setValidata('main') !!}
</form>
@endsection
