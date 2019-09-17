@extends('m01::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('m01.name') !!}
    </p>
@stop
