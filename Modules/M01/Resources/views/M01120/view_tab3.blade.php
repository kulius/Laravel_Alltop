@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHTML = null;
    $tHTML = null;
    switch ($status) {
        case 'add':
        case 'edit':
        //case 'view':
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
            //  $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'click', 'value' => 'back','text'=>'通過')));
            //  $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'click', 'value' => 'back','text'=>'不通過')));
            // // $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'm01120.view2','text'=>'未通過')));
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm01120')));
            //判斷哪個頁簽的編輯頁傳來的Save狀態
            //$aBody[] = array('body' => $eZui->setHideBox(array("name" => "tab", "value" => "tab1")));
        break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm01120')));
        break;
    }
    //$sHTML .= $eZui->setHideBox(array("name" => "DayfgID", "value" => $vDayfg["DayfgID"]));
    $sHTML .= $eZui->setGroup(array('body' => $aBody));
    $aOption   = array();
    $aOption[] = array("value" => "1", "text" => _("是"));
    $aOption[] = array("value" => "2", "text" => _("否"));

    $aBody = array();
    $aBody[] = array("flex" => "4", "body" => $eZui->setComboBox(array("head" => __("所屬選單"), "name" => "BelongMenu", "value" => '','option'=>'')));
    $aBody[] = array("flex" => "4", "body" => $eZui->setTextBox(array("head" => __("功能編號/名稱"), "name" => "FunctionNoOrName", "value" => '')));
    $aBody[] = array("flex" => "4", "body" => $eZui->setCheckBox(array("head" => _("只顯使已授權功能"), "name" => "ShowAuz", "value" => "", "option" => $aOption, "inline" => true)));

    //$sHTML .= $eZui->setHideBox(array("name" => "DayfgID", "value" => $vDayfg["DayfgID"]));
    $tHTML .= $eZui->setGroup(array('body' => $aBody));

     $aField = array();
    $aField[] = array('head' => __('功能編號'), 'name' => 'FunshionNo', 'width' => '10%');
    $aField[] = array('head' => __('功能名稱'), 'name' => 'FunshionName', 'width' => '20%');
    $aData = array();
    foreach ($data as $skData => $svData) {
        $saaID      =trim($svData['aaID']);
        $sFunshionNo      =trim($svData['FunshionNo']);
        $sFunshionName      =trim($svData['FunshionName']);

        //$aBtn   = array();
        //$aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "m01120view", "param" => array("view", $saaID)));
         //$aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "m01120_view2", "param" => array("edit", $saaID)));

        //隱藏（KEY）
        $aData[$skData]["aaID"] = $saaID;

        //顯示
        $aData[$skData]["FunshionNo"]         = $sFunshionNo;
        $aData[$skData]["FunshionName"]         = $sFunshionName;

//        $aData[$skData]["btn"]              = implode("", $aBtn);
    }

    $aSet = array(
    'field' => $aField,
    'data' => $aData,
    //"btn" => array(""),
    );

    $tHTML .= $eZui->setGridMul($aSet);


    $aParams = array(
    'aTabInfo' => array(
    'm01120_view' => array('param' => array($status,$id), 'title'=>'群組功能'),
    'm01120_view_tab2' => array('param' => array($status,$id), 'title'=>'所屬人員'),
    'm01120_view_tab3' => array('param' => array($status,$id), 'title'=>'功能權限','view' => $tHTML, 'current' => 'active'),
    )
    );
    $sHTML .= $eZui->setTab($aParams);


    @endphp
    {!! $sHTML !!}
    {!! $eZui->setValidata('main') !!}
</form>
@endsection
