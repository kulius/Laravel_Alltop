@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')

@include('layouts.error_tips', array('errors' => $errors))

    <form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
	@php
    $sHtml = null;

        $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
        $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm04170')));
    $sHtml .= $eZui->setGroup(array("body" => $aBody));

    $aBody   = array();
    $aBody[] = array("head" => _("問卷名稱"), "flex" => "2", "body" => $eZui->setFont(array("text" => _("1081學校系統問卷調查"))));
    $sHtml.= $eZui->setGroup(array("body" => $aBody));
    
    $aBody   = array();

    $aOption   = array();
    $aOption[] = array("value" => "1", "text" => _("是"));
    $aOption[] = array("value" => "2", "text" => _("否"));

    $aBody[] = array("flex" => "6", "body" => $eZui->setRadioBox(array("head" => _("是否使用過此系統進行成績登打以外的功能?"), "name" => "radio_inline", "value" => "", "option" => $aOption, "inline" => true)));
    $sHtml.= $eZui->setGroup(array("body" => $aBody));

    $aBody   = array();
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("text" => _("上一題"), "style" => "so")));
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("text" => _("下一題"), "style" => "so")));
    $sHtml.= $eZui->setGroup(array("body" => $aBody));


    $aMemo   = array();
    $aMemo[] = $eZui->setFont(array("text" => _("備註："), "style" => "r"));
    $aMemo[] = _("1.暫存：可依照使用者填寫問狀況做暫時儲存，下次再進填寫時，就會載入使用者填寫暫存記錄。");
    $aMemo[] = _("2.填完送出：當所有題目填寫完時，此按鈕才會出現。");

    $sHtml .= $eZui->setAlert(array("text" => $aMemo, "style" => "y"));

	@endphp
    {!! $sHtml !!}
    {!! $eZui->setValidata('main') !!}
    </form>
@endsection
