@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id="main" method='POST'>
{{ csrf_field() }}
{!! $eZui->setValidata('main') !!}

<nav>
    <div class='nav nav-tabs mb-3' id='nav-tab' role='tablist'>
        <a class='nav-item nav-link active' id='nav_tab_0' data-toggle='tab' href='#nav_0' role='tab' aria-controls='nav_0' aria-selected='true'>
            {{ _i('子選單') }}
        </a>
        <a class='nav-item nav-link' id='nav_tab_1' data-toggle='tab' href='#nav_1' role='tab' aria-controls='nav_1' aria-selected='false'>
            {{ _i('主選單') }}
        </a>
    </div>
</nav>
<div class='tab-content' id='nav-tabContent'>
    <div class='tab-pane fade show active' id='nav_0' role='tabpanel' aria-labelledby='nav_tab_0'>
        @include('s01101.index_1')
    </div>
    <div class='tab-pane fade show' id='nav_1' role='tabpanel' aria-labelledby='nav_tab_1'>
        @include('s01101.index_2')
    </div>
</div>
<form>
@endsection
