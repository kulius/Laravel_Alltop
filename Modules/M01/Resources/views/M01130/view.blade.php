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
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm01130')));
            //判斷哪個頁簽的編輯頁傳來的Save狀態
            //$aBody[] = array('body' => $eZui->setHideBox(array("name" => "tab", "value" => "tab1")));
        break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm01130')));
        break;
    }

    //$sHTML .= $eZui->setHideBox(array("name" => "DayfgID", "value" => $vDayfg["DayfgID"]));
    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    $aBody = array();
    $aBody[] = array("flex" => "3", "body" => $eZui->setComboBox(array("head" => __("模組類別"), "name" => "SignPerson", "value" => '','option'=>'','seq'=>'true')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setComboBox(array("head" => __("共用程式存放模組"), "name" => "SignMember", "value" => '','option'=>'')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setTextBox(array("head" => __("中文名稱"), "name" => "SignMember", "value" => '','seq'=>'')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setTextBox(array("head" => __("目錄編號"), "name" => "SignMember", "value" => '')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setComboBox(array("head" => __("程式編號"), "name" => "SignMember", 'option'=>'',"value" => '','seq'=>'true')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setTextBox(array("head" => __("程式名稱"), "name" => "SignMember", "value" => '','status'=>'')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setComboBox(array("head" => __("客製化代號"), "name" => "SignPerson", "value" => '','option'=>'','seq'=>'true')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setComboBox(array("head" => __("狀態"), "name" => "SignPerson", "value" => '','option'=>'','seq'=>'true')));
    $aBody[] = array("flex" => "6", "body" => $eZui->setJumpSel(array("head" => _("icon"), "name" => "jump_sgl", "value" => "", "option" => "", "url" => "")));
    $aBody[] = array("flex" => "3", "body" => $eZui->setTextBox(array("head" => __("異動日期"), "name" => "SignMember", "value" => '')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setTextBox(array("head" => __("異動人員"), "name" => "SignMember", "value" => '')));
    $aBody[] = array("flex" => "12", "body" => $eZui->setTextArea(array("head" => __("原因"), "name" => "SignMember", "value" => '')));
    $aBody[] = array("flex" => "12", "body" => $eZui->setEditArea(array("head" => _("資訊"), "name" => "editarea", "value" => "")));
    $aBody[] = array("flex" => "3", "body" => $eZui->setTextBox(array("head" => __("授權群組帳號"), "name" => "SignPerson", "value" => '','option'=>'','seq'=>'true')));


    $aBody[] = array("flex" => "3", "body" => $eZui->setTextBox(array("head" => __("授權個人帳號"), "name" => "SignMember", "value" => '')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setComboBox(array("head" => __("功能啟用/停用"), "name" => "SignMember", "value" => '')));
    // $aBody2   = array();
    // $aBody2[] = array("flex" => "auto", "body" => $eZui->setDateBox(array("name" => "AbsentSDate_srh", "value" => '')));
    // $aBody2[] = array("flex" => "1", "body" => $eZui->setTextBox(array("value" => '~', "status"=>"view")));
    // $aBody2[] = array("flex" => "auto", "body" => $eZui->setDateBox(array("name" => "AbsentEDate_srh", "value" => '')));
    // $sDateHtml = $eZui->setGroup(array('body' => $aBody2));

    // $aBody[] = array("flex" => "6", "head" => __("擔任導師起訖日"), "body" => $sDateHtml);

    // $sHTML .= $eZui->setGroup(array('body' => $aBody));
    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    $aMemo   = array();
    $aMemo[] = $eZui->setFont(array("text" => _("備註："), "style" => "r"));
    $aMemo[] = _("1. 授權群組編號值跟授權個人帳號值都是由群組維護帶出來的");
    $sHTML .= $eZui->setAlert(array("text" => $aMemo, "style" => "y"));

    @endphp
    {!! $sHTML !!}
    {!! $eZui->setValidata('main') !!}
</form>
@endsection
