@extends('m07::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('m07.name') !!}
    </p>
@stop
