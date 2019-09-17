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
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm02120')));
            //判斷哪個頁簽的編輯頁傳來的Save狀態
            //$aBody[] = array('body' => $eZui->setHideBox(array("name" => "tab", "value" => "tab1")));
        break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm02120')));
        break;
    }

    //$sHTML .= $eZui->setHideBox(array("name" => "DayfgID", "value" => $vDayfg["DayfgID"]));
    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    $aBody = array();
    $aBody[] = array("flex" => "3", "body" => $eZui->setTextBox(array("head" => __("帳號"), "name" => "SignPerson", "value" => 'T48865123','seq'=>'true','status'=>'view')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setTextBox(array("head" => __("輸入舊密碼"), "name" => "SignMember", "value" => '','seq'=>'')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setTextBox(array("head" => __("輸入新密碼"), "name" => "SignMember", "value" => '')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setTextBox(array("head" => __("再次輸入新密碼"), "name" => "SignMember", "value" => '')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setTextBox(array("head" => __("驗證碼"), "name" => "SignMember", "value" => '')));
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
    $aMemo[] = _("1. 使用者可修改密碼，密碼需符合複雜度(2種以上英、數、符)與文字長度(大於8碼)。");
    $sHTML .= $eZui->setAlert(array("text" => $aMemo, "style" => "y"));

    @endphp
    {!! $sHTML !!}
    {!! $eZui->setValidata('main') !!}
</form>
@endsection
