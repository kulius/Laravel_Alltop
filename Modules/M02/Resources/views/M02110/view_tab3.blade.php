@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}

@php
    $sHtml = null;
    $tHtml = null;

    switch ($status) {
        case 'add':
        case 'edit':
        //case 'view':
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
            //  $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'click', 'value' => 'back','text'=>'通過')));
              $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'click', 'value' => 'back','text'=>'清除授權群組權限')));
            // // $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'm02110.view2','text'=>'未通過')));
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm02110')));
            //判斷哪個頁簽的編輯頁傳來的Save狀態
            //$aBody[] = array('body' => $eZui->setHideBox(array("name" => "tab", "value" => "tab1")));
        break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm02110')));
        break;
    }
    //$sHtml .= $eZui->setHideBox(array("name" => "DayfgID", "value" => $vDayfg["DayfgID"]));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody = array();
    $aBody[] = array("flex" => "3", "body" => $eZui->setComboBox(array("head" => __("模組類別"), "name" => "Unit", "value" => '','option'=>'')));

    //$sHtml .= $eZui->setHideBox(array("name" => "DayfgID", "value" => $vDayfg["DayfgID"]));
    $tHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody = array();
    $aBody[] = array("flex" => 'auto', "body" => $eZui->setBtnSubmit(array('ex' => 'search', 'value' => 'search')));
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'click', 'value' => 'back','text'=>'授權/停權')));

    $tHtml .= $eZui->setGroup(array('body' => $aBody));


    $aField = array();
    $aField[] = array('head' => __('中文名稱'), 'name' => 'ChineseName', 'width' => '10%');
    $aField[] = array('head' => __('授權群組編號'), 'name' => 'AuzGroupNo', 'width' => '20%');
    $aField[] = array('head' => __('個人權限'), 'name' => 'aa', 'width' => '20%');
    $aData = array();
    foreach ($data as $skData => $svData) {
        $saaID      =trim($svData['aaID']);
        $sChineseName      =trim($svData['ChineseName']);
        $sAuzGroupNo      =trim($svData['AuzGroupNo']);
        $saa      =trim($svData['aa']);

        //隱藏（KEY）
        $aData[$skData]["aaID"] = $saaID;

        //顯示
        $aData[$skData]["ChineseName"]         = $sChineseName;
        $aData[$skData]["AuzGroupNo"]         = $sAuzGroupNo;
        $aData[$skData]["aa"]         = $saa;

    }

    $aSet = array(
    'field' => $aField,
    'data' => $aData,
    );

    $tHtml .= $eZui->setGrid($aSet);


    $aParams = array(
    'aTabInfo' => array(
    'm02110_view' => array('param' => array($status,$id), 'title'=>'帳號管理'),
    'm02110_view_tab2' => array('param' => array($status,$id), 'title'=>'所屬群組'),
    'm02110_view_tab3' => array('param' => array($status,$id), 'title'=>'個人功能權限','view' => $tHtml, 'current' => 'active'),
    )
    );
    $sHtml .= $eZui->setTab($aParams);


    @endphp
    {!! $sHtml !!}
    {!! $eZui->setValidata('main') !!}
</form>
@endsection
