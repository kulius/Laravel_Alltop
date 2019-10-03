@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')

@include('layouts.error_tips', array('errors' => $errors))

    <form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
	@php
    $sHtml = null;

    switch ($status) {
        case 'edit':
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm04150')));

            break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm04150')));
            break;
    }
    $sHtml .= $eZui->setGroup(array("body" => $aBody));

    $aBody   = array();
    $aOption   = array();
    $aOption[] = array("value" => "1", "text" => _("是"));
    $aOption[] = array("value" => "2", "text" => _("否"));
    $aBody[] = array("flex" => "6", "body" => $eZui->setRadioBox(array("name" => "radio_inline", "value" => "", "option" => $aOption, "inline" => true)));
    $aBody[] = array("flex"=>3,"body" => $eZui->setComboBox(array("name" => "", "value" => '', "option" =>'', "select" => false)));
    $sGroup = $eZui->setGroup(array("body" => $aBody));

    $aBody   = array();
    $aBody[] = array("head" => _("是否同步發送公告兼範本選擇"), "body" => $sGroup);
    $sHtml .= $eZui->setGroup(array("body" => $aBody));

    $aBody   = array();
    $aBody[] = array("head" => _("學年"), "flex" => "2", "body" => $eZui->setFont(array("text" => _("108"))));
    $aBody[] = array("head" => _("學期"), "flex" => "2", "body" => $eZui->setFont(array("text" => _("第一學期"))));
    $aBody[] = array("flex"=>2,"body" => $eZui->setComboBox(array("head" => _("選擇問卷"), "name" => "", "value" => '', "option" =>'', "select" => false)));
    $aBody[] = array("flex"=>2,"head" => _("群組"), "flex" => "2", "body" => $eZui->setFont(array("text" => _("教師"))));
    $aBody[] = array("flex"=>2,"body" => $eZui->setDateBox(array("head" => _("填寫時間迄"), "name" => "date", "value" => "")));
    $aBody[] = array("flex"=>2,"body" => $eZui->setTextBox(array("head" => _("範本名稱"), "name" => "text", "value" => "")));

    $aOption   = array();
    $aOption[] = array("value" => "1", "text" => _("學生"));
    $aOption[] = array("value" => "2", "text" => _("教師"));
    $aOption[] = array("value" => "3", "text" => _("校內人員"));
    $aOption[] = array("value" => "4", "text" => _("校友"));

    $aBody[] = array("flex" => "3", "body" => $eZui->setRadioBox(array("head" => _("適用群組(可多選)"), "name" => "radio_inline", "value" => "", "option" => $aOption, "inline" => true)));

    $aBody[] = array("flex"=>2,"body" => $eZui->setTextBox(array("head" => _("主旨"), "name" => "text", "value" => "")));
    $aBody[] = array("flex" => "12", "body" => $eZui->setEditArea(array("head" => _("內容"), "name" => "editarea", "value" => "")));
    $sHtml .= $eZui->setGroup(array("body" => $aBody));


	@endphp
    {!! $sHtml !!}
    {!! $eZui->setValidata('main') !!}
    </form>
@endsection
