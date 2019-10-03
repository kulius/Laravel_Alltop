@extends('b13::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('b13.name') !!}
    </p>
@stop
