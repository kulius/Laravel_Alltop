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
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm04150_tab4')));

            break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm04150_tab4')));
            break;
    }
    $sHtml .= $eZui->setGroup(array("body" => $aBody));

    $aBody   = array();
    $aBody[] = array("flex"=>2,"body" => $eZui->setTextBox(array("head" => _("範本名稱"), "name" => "text", "value" => "")));
    $aBody[] = array("flex"=>2,"body" => $eZui->setTextBox(array("head" => _("主旨"), "name" => "text", "value" => "")));
    $aBody[] = array("flex" => "12", "body" => $eZui->setEditArea(array("head" => _("內容"), "name" => "editarea", "value" => "")));
    $sHtml .= $eZui->setGroup(array("body" => $aBody));


	@endphp
    {!! $sHtml !!}
    {!! $eZui->setValidata('main') !!}
    </form>
@endsection
