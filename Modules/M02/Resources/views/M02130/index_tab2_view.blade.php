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
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm02120_tab2')));
    //判斷哪個頁簽的編輯頁傳來的Save狀態
    $aBody[] = array('body' => $eZui->setHideBox(array("name" => "tab", "value" => "tab2")));
    break;
    default:
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm02120_tab2')));
    break;
    }
    //$sHTML .= $eZui->setHideBox(array("name" => "DayfgID", "value" => $vDayfg["DayfgID"]));
    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    $aOption   = array();
    $aOption[] = array("value" => "1", "text" => _("是"));
    $aOption[] = array("value" => "2", "text" => _("否"));

    $aBody = array();
    $aBody[] = array("flex" => "3", "body" => $eZui->setComboBox(array("head" => __("部別"), "name" => "DayfgID", "value" => '','option'=>'')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setComboBox(array("head" => __("學制"), "name" => "ClassTypeID", "value" => '','option'=>'')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setComboBox(array("head" => __("學院"), "name" => "CollegeID", "value" => '','option'=>'')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setComboBox(array("head" => __("系所"), "name" => "UnitID", "value" => '','option'=>'')));
    $aBody[] = array("flex" => "6", "body" => $eZui->setJumpSel(array("head" => _("授權對象"), "name" => "AuzObject", "value" => "", "option" => "", "url" => "e00000_jump_mul")));
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
