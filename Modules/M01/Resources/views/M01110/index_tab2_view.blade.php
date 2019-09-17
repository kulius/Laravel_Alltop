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
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm01110_tab2')));
    //判斷哪個頁簽的編輯頁傳來的Save狀態
    $aBody[] = array('body' => $eZui->setHideBox(array("name" => "tab", "value" => "tab2")));
    break;
    default:
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm01110_tab2')));
    break;
    }
    //$sHTML .= $eZui->setHideBox(array("name" => "DayfgID", "value" => $vDayfg["DayfgID"]));
    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    $aOption   = array();
    $aOption[] = array("value" => "1", "text" => _("是"));
    $aOption[] = array("value" => "2", "text" => _("否"));

    $aBody = array();
    $aBody[] = array("flex" => "3", "body" => $eZui->setComboBox(array("head" => __("主選單"), "name" => "SignPerson", "value" => '','option'=>'')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setTextBox(array("head" => __("功能編號(英數三碼 例:a01)"), "name" => "SignMember", "value" => '')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setTextBox(array("head" => __("功能資料夾"), "name" => "SignMember", "value" => '')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setTextBox(array("head" => __("選單排序"), "name" => "SignMember", "value" => '')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setComboBox(array("head" => __("是否顯示"), "name" => "SignMember", 'option'=>'',"value" => '')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setTextBox(array("head" => __("異動日期"), "name" => "SignMember", "value" => '','status'=>'view')));
    $aBody[] = array("flex" => "12", "body" => $eZui->setTextArea(array("head" => __("異動原因"), "name" => "SignMember", "value" => '')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setTextBox(array("head" => __("授權群組編號admin_bhr"), "name" => "SignMember", "value" => '','status'=>'view')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setTextBox(array("head" => __("授權個人帳號"), "name" => "SignMember", "value" => '','status'=>'view')));
    // // $aBody2   = array();
    // // $aBody2[] = array("flex" => "auto", "body" => $eZui->setDateBox(array("name" => "AbsentSDate_srh", "value" => '')));
    // // $aBody2[] = array("flex" => "1", "body" => $eZui->setTextBox(array("value" => '~', "status"=>"view")));
    // // $aBody2[] = array("flex" => "auto", "body" => $eZui->setDateBox(array("name" => "AbsentEDate_srh", "value" => '')));
    // // $sDateHtml = $eZui->setGroup(array('body' => $aBody2));

    // $aBody[] = array("flex" => "6", "head" => __("擔任導師起訖日"), "body" => $sDateHtml);

    $sHTML .= $eZui->setGroup(array('body' => $aBody));




    @endphp
    {!! $sHTML !!}
    {!! $eZui->setValidata('main') !!}

</form>
@endsection
