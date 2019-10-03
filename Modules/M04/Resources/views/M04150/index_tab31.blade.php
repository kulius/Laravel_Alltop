@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')

@include('layouts.error_tips', array('errors' => $errors))

    <form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
	@php
    $sHtml = null;

    $aBody   = array();
    $aBody[] = array("head" => _("學年"), "flex" => "2", "body" => $eZui->setFont(array("text" => _("108"))));
    $aBody[] = array("head" => _("學期"), "flex" => "2", "body" => $eZui->setFont(array("text" => _("第一學期"))));
    $aBody[] = array("head" => _("問卷編號(系統自動產生)"), "flex" => "2", "body" => $eZui->setFont(array("text" => _("10801801"))));
    $aBody[] = array("body" => $eZui->setTextBox(array("head" => _("問卷名稱"), "name" => "text", "value" => "")));
    $sHtml.= $eZui->setGroup(array("body" => $aBody));

    $aBody   = array();

    $aOption   = array();
    $aOption[] = array("value" => "1", "text" => _("學生"));
    $aOption[] = array("value" => "2", "text" => _("教師"));
    $aOption[] = array("value" => "3", "text" => _("校內人員"));
    $aOption[] = array("value" => "4", "text" => _("校友"));

    $aBody[] = array("flex" => "6", "body" => $eZui->setCheckBox(array("head" => _("調查對象(可複選)"), "name" => "radio_inline", "value" => "", "option" => $aOption, "inline" => true)));

    $sHtml.= $eZui->setGroup(array("body" => $aBody));

    $aParams =  array(
                    'aTabInfo' => array(
                        'm04150_tab31' => array('param' =>'','title'=>'問卷資料','view' => $sHtml, 'current' => 'active'),
                        'm04150_tab32' => array('param' =>'','title'=>'題目設定'),
                        )
                );

            $aBody   = array();
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm04150_tab3')));
            $sHtml   = $eZui->setGroup(array("body" => $aBody));

    $sHtml .= $eZui->setTab($aParams);

	@endphp
    {!! $sHtml !!}
    {!! $eZui->setValidata('main') !!}
    </form>
@endsection
