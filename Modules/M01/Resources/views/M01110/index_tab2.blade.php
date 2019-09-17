@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='judge' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody = array();
    $aBody[] = array("flex" => '3', "body" => $eZui->setComboBox(array("head" => __("所屬主選單"), "name" => "BelongMenu_srh", "value" =>'' , "option" => '', "select" => false)));
    $aBody[] = array("flex" => '3', "body" => $eZui->setTextBox(array("head" => __("功能編號/功能名稱"), "name" => "Function1_srh", "value" =>'' , "select" => false)));
    $aBody[] = array("flex" => '3', "body" => $eZui->setComboBox(array("head" => __("是否顯示"), "name" => "IfShow_srh", "value" => '', "option" => '',"select" => false)));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));



    $aBody = array();
    $aBody[] = array("flex" => 'auto', "body" => $eZui->setBtnSubmit(array('ex' => 'search', 'value' => 'search')));
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'm01110_view', 'param' => array('add'))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));


    $aField = array();
    $aField[] = array('head' => __('所屬主選單'), 'name' => 'BelongMenu', 'width' => '10%');
    $aField[] = array('head' => __('功能編號'), 'name' => 'FunctionNo', 'width' => '20%');
    $aField[] = array('head' => __('功能名稱'), 'name' => 'FunctionName', 'width' => '20%');
    $aField[] = array('head' => __('功能資料夾'), 'name' => 'FunctionDataList', 'width' => '20%');
    $aField[] = array('head' => __('選單排序'), 'name' => 'ListSort', 'width' => '20%');
    $aField[] = array('head' => __('是否顯示'), 'name' => 'IfShow', 'width' => '20%');
    $aField[] = array('head' => __('異動日期'), 'name' => 'ReEndTime', 'width' => '20%');
    $aField[] = array("head" => __("功能"), "name" => "btn", "align" => "right", 'width' => '20%');

    $aData = array();
    foreach ($data as $skData => $svData) {
        $saaID      =trim($svData['aaID']);
        $sBelongMenu      =trim($svData['BelongMenu']);
        $sFunctionNo      = trim($svData["FunctionNo"]);
        $sFunctionName      = trim($svData["FunctionName"]);
        $sFunctionDataList     = trim($svData["FunctionDataList"]);
        $sListSort     = trim($svData["ListSort"]);
        $sIfShow     = trim($svData["IfShow"]);
        $sReEndTime     = trim($svData["ReEndTime"]);
        $aBtn   = array();
        $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "m01110_tab2_view", "param" => array("view", $saaID)));
        $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "m01110_tab2_view", "param" => array("edit", $saaID)));

        //隱藏（KEY）
       $aData[$skData]["aaID"] = $saaID;

        //顯示
        $aData[$skData]["BelongMenu"]         = $sBelongMenu;
        $aData[$skData]["FunctionNo"]         = $sFunctionNo;
        $aData[$skData]["FunctionName"]        = $sFunctionName;
        $aData[$skData]["FunctionDataList"]    = $sFunctionDataList;
        $aData[$skData]["ListSort"]    = $sListSort;
        $aData[$skData]["IfShow"]    = $sIfShow;
        $aData[$skData]["ReEndTime"]    = $sReEndTime;

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
            'm01110' => array('param' => "", 'title'=>'見習公告'),
            'm01110_tab2' => array('param' => "", 'title'=>'填寫見習結果結束時間', 'view' => $sHtml, 'current' => 'active'),
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
