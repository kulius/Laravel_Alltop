@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id="main" method='POST'>
{{ csrf_field() }}
<?php
$html = null;

$body = array();

switch ($status) {
    case 'add':
    case 'edit':
        $body[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
        $body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm06140')));
        break;
    default:
        $body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm06140')));
        break;
}

$html .= $eZui->setGroup(array('body' => $body));
?>
{!! $html !!}

<nav>
    <div class='nav nav-tabs mb-3' id='nav-tab' role='tablist'>
        <a class='nav-item nav-link active' id='nav_tab_0' data-toggle='tab' href='#nav_0' role='tab' aria-controls='nav_0' aria-selected='true'>
            表單資訊
        </a>
        <a class='nav-item nav-link' id='nav_tab_1' data-toggle='tab' href='#nav_1' role='tab' aria-controls='nav_1' aria-selected='false'>
            簽核資訊
        </a>
    </div>
</nav>
<div class='tab-content' id='nav-tabContent'>
    <div class='tab-pane fade show active' id='nav_0' role='tabpanel' aria-labelledby='nav_tab_0'>
    	@include('m06140.view_1')
    </div>
    <div class='tab-pane fade show' id='nav_1' role='tabpanel' aria-labelledby='nav_tab_1'>
    	@include('m06140.view_2')
    </div>
</div>

{!! $eZui->setValidata('main') !!}
<form>
@endsection
