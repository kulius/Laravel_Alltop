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
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'e00304_index2')));
            break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'e00304_index2')));
            break;
    }

    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    $aOption   = array();
    $aOption[] = array("value" => "1", "text" => _("使用中"));
    $aOption[] = array("value" => "0", "text" => _("停用"));

    $aBody   = array();

    $aBody[] = array("flex" => 4,"body" => $eZui->setComboBox(array("head" => _("狀態"), "name" => "GroupState", "value" => $data["GroupState"], "option" => $aOption, "select" => false)));

    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array("flex" => 4, "body" => $eZui->setComboBox(array("head" => _("報部單位"), "name" => "EducationDepartment", "value" => $data["EducationDepartment"], "option" => $aEducationDepartment, "select" => false)));
    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array("flex" => 4, "body" => $eZui->setTextBox(array("head" => __("教育部群組名稱"), "name" => "GroupName", "value" => $data['GroupName'])));
    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array("flex" => 4, "body" => $eZui->setTextBox(array("head" => __("教育部群組代碼"), "name" => "GroupCode", "value" => $data['GroupCode'])));
    $sHTML .= $eZui->setGroup(array('body' => $aBody));
@endphp
    {!! $sHTML !!}
    {!! $eZui->setValidata('main') !!}
</form>
@endsection
