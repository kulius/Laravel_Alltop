@extends('m02::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('m02.name') !!}
    </p>
@stop
