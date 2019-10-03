@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody=array();
        switch ($status) {
        case 'add':
        case 'edit':
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'b13220_tab1')));
        break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'b13220_tab1')));
        break;
    }
    $sHtml .= $eZui->setGroup(array('body' => $aBody));
    $aBody   = array();
    $aBody[] = array('flex' => '4', 'body' => $eZui->setTextBox(array('head' => __('代號'), 'name' => 'text', 'value' => old('text') )));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setTextBox(array('head' => __('常用字彙'), 'name' => 'text', 'value' => old('text') )));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));








    @endphp
    {!! $sHtml !!}
    {!! $eZui->setValidata('main') !!}
</form>
@endsection
