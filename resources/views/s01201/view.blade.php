@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST'>
{{ csrf_field() }}
<?php
$html = null;

$body = array();

switch ($status) {
    case 'add':
    case 'edit':
        $body[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
        $body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 's01201')));
        break;
    default:
        $body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 's01201')));
        break;
}

$html .= $eZui->setGroup(array('body' => $body));
?>
{!! $html !!}
{!! $eZui->setValidata('main') !!}

<nav>
    <div class='nav nav-tabs mb-3' id='nav-tab' role='tablist'>
        <a class='nav-item nav-link active' id='nav_tab_0' data-toggle='tab' href='#nav_0' role='tab' aria-controls='nav_0' aria-selected='true'>
            {{ _i('群組資料') }}
        </a>
        <a class='nav-item nav-link' id='nav_tab_1' data-toggle='tab' href='#nav_1' role='tab' aria-controls='nav_1' aria-selected='false'>
            {{ _i('群組人員') }}
        </a>
        <a class='nav-item nav-link' id='nav_tab_2' data-toggle='tab' href='#nav_2' role='tab' aria-controls='nav_2' aria-selected='false'>
            {{ _i('授權功能（群組）') }}
        </a>
    </div>
</nav>
<div class='tab-content' id='nav-tabContent'>
    <div class='tab-pane fade show active' id='nav_0' role='tabpanel' aria-labelledby='nav_tab_0'>
        @include('s01201.view_1')
    </div>
    <div class='tab-pane fade show' id='nav_1' role='tabpanel' aria-labelledby='nav_tab_1'>
        @include('s01201.view_2')
    </div>
    <div class='tab-pane fade show' id='nav_2' role='tabpanel' aria-labelledby='nav_tab_2'>
        @include('s01201.view_3')
    </div>
</div>
<form>
@endsection
