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
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'e00304')));
            break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'e00304')));
            break;
    }

    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    $aOption   = array();
    $aOption[] = array("value" => "1", "text" => _("使用中"));
    $aOption[] = array("value" => "0", "text" => _("停用"));

    $aBody   = array();
    $aBody[] = array("flex" => 4,"body" => $eZui->setComboBox(array("head" => _("狀態"), "name" => "state", "value" => $data["state"], "option" => $aOption, "req" => true, "select" => false)));

    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();

    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('教育部代碼群組'), 'name' => 'DataGroupID', 'value' => $sGroupID, 'option' => $aGroupCombo, 'req' => true)));
    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array("flex" => 4, "body" => $eZui->setTextBox(array("head" => __("教育部代碼名稱"), "name" => "Name", "value" => $data['Name'])));
    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array("flex" => 4, "body" => $eZui->setTextBox(array("head" => __("教育部代碼"), "name" => "Code", "value" => $data['Code'])));
    $sHTML .= $eZui->setGroup(array('body' => $aBody));

@endphp
    {!! $sHTML !!}
    {!! $eZui->setValidata('main') !!}
</form>
@endsection
