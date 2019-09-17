@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')


@section('content')

<div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav_tab_0" data-toggle="tab" href="#nav_0" role="tab"
     aria-controls="nav_0" aria-selected="true">Grid</a>
    <a class="nav-item nav-link" id="nav_tab_1" data-toggle="tab" href="#nav_1" role="tab"
     aria-controls="nav_1" aria-selected="false">Grid：單選</a>
    <a class="nav-item nav-link" id="nav_tab_1" data-toggle="tab" href="#nav_2" role="tab"
     aria-controls="nav_1" aria-selected="false">Grid：多選</a>
    <a class="nav-item nav-link" id="nav_tab_1" data-toggle="tab" href="#nav_3" role="tab"
     aria-controls="nav_1" aria-selected="false">Button</a>
    <a class="nav-item nav-link" id="nav_tab_1" data-toggle="tab" href="#nav_4" role="tab"
     aria-controls="nav_1" aria-selected="false">Form</a>
    <a class="nav-item nav-link" id="nav_tab_1" data-toggle="tab" href="#nav_5" role="tab"
     aria-controls="nav_1" aria-selected="false">Form：驗證</a>
    <a class="nav-item nav-link" id="nav_tab_1" data-toggle="tab" href="#nav_6" role="tab"
     aria-controls="nav_1" aria-selected="false">Layout</a>
    <a class="nav-item nav-link" id="nav_tab_1" data-toggle="tab" href="#nav_7" role="tab"
     aria-controls="nav_1" aria-selected="false">Other</a>
</div>

<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav_0" role="tabpanel" aria-labelledby="nav_tab_0">
        @include('example::E00000.index_grid')
    </div>
    <div class="tab-pane fade" id="nav_1" role="tabpanel" aria-labelledby="nav_tab_1">
        @include('example::E00000.index_grid_sgl')
    </div>
    <div class="tab-pane fade" id="nav_2" role="tabpanel" aria-labelledby="nav_tab_2">
        @include('example::E00000.index_grid_mul')
    </div>
    <div class="tab-pane fade" id="nav_3" role="tabpanel" aria-labelledby="nav_tab_3">
        @include('example::E00000.index_button')
    </div>
    <div class="tab-pane fade" id="nav_4" role="tabpanel" aria-labelledby="nav_tab_4">
        @include('example::E00000.index_form')
    </div>
    <div class="tab-pane fade" id="nav_5" role="tabpanel" aria-labelledby="nav_tab_5">
        @include('example::E00000.index_form_validate')
    </div>
    <div class="tab-pane fade" id="nav_6" role="tabpanel" aria-labelledby="nav_tab_6">
        @include('example::E00000.index_layout')
    </div>
    <div class="tab-pane fade" id="nav_7" role="tabpanel" aria-labelledby="nav_tab_7">
        @include('example::E00000.index_other')
    </div>
</div>

<script>
$(document).ready(function(){
    @if($current)
        $('#nav_tab_{{ $current }}').tab('show');
    @endif
});
</script>
{{-- @include('tabScript') --}}
@endsection