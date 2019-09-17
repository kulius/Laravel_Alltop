@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id="main" method='POST'>
{{ csrf_field() }}

{!! $eZui->setValidata('main') !!}
<form>
@endsection
