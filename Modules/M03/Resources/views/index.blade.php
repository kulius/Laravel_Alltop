@extends('m03::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('m03.name') !!}
    </p>
@stop
