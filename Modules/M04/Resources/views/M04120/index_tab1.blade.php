@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')

@include('layouts.error_tips', array('errors' => $errors))

    <form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
	@php
    $sHtml = null;

    $aBody   = array();
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm04120')));
    $sHtml .= $eZui->setGroup(array("body" => $aBody));

    $aBody   = array();
    $aBody[] = array("flex"=>3,"body" => $eZui->setComboBox(array("head" => _("試題類型"), "name" => "", "value" => '', "option" =>'', "select" => false)));
    $aBody[] = array("flex"=>3,"body" => $eZui->setTextBox(array("head" => _("題目名稱"), "name" => "text", "value" => "")));

    $sHtml.= $eZui->setGroup(array("body" => $aBody));


    $aParams =  array(
                    'aTabInfo' => array(
                        'm04120_tab1' => array('param' =>'','title'=>'題目資訊','view' => $sHtml, 'current' => 'active'),
                        'm04120_tab2' => array('param' =>'','title'=>'選項'),
                        )
                );

    $sHtml = $eZui->setTab($aParams);

	@endphp
    {!! $sHtml !!}
    {!! $eZui->setValidata('main') !!}
    </form>
@endsection
