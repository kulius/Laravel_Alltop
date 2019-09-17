@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
@php
    $sHTML = null;
    $aRoutePar = array($UpperStatus, $UpperID);

    switch ($status) {
        case 'add':
        case 'edit':
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'multi_view2_index', 'param' => $aRoutePar)));
            break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'multi_view2_index', 'param' => $aRoutePar)));
            break;
    }

    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array("flex" => 2, "body" => $eZui->setTextBox(array("head" => __("文字方塊"), "name" => "text", "value" => $data['text'])));
    $aBody[] = array("flex" => 2, "body" => $eZui->setTextBox(array("head" => __("文字區塊"), "name" => "textarea", "value" => $data['textarea'])));
    // $aBody[] = array("flex" => 2, "body" => $eZui->setNumberBox(array("head" => __("數字方塊"), "name" => "number", "value" => $data['number'])));

    $sHTML .= $eZui->setGroup(array('body' => $aBody));
@endphp
    {!! $sHTML !!}
    {!! $eZui->setValidata('main') !!}
</form>
@endsection
