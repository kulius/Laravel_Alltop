@extends('m06::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('m06.name') !!}
    </p>
@stop
