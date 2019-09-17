@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')


@section('content')

<div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav_tab_0" data-toggle="tab" href="#nav_0" data-url="http://alltop.test/a01NewStudent/regClass/tab1" role="tab"
     aria-controls="nav_0" aria-selected="true">班級資料維護</a>
    <a class="nav-item nav-link" id="nav_tab_1" data-toggle="tab" href="#nav_1" data-url="http://alltop.test/a01NewStudent/regClass/tab2"
     role="tab" aria-controls="nav_1" aria-selected="false">學期班級資料維護</a>
</div>

   {{--  @php
    $sHtml = null;
    
    $aNavs = array();
    $aNavs[] = array("head" => _("班級資料維護"), "body" => '', 'route' => 'regClass_view1');
    $aNavs[] = array("head" => _("學期班級資料維護"), "body" => '','route' => 'regClass_view2' );

    $sHtml .= $eZui->setNavs($aNavs);

     echo $sHtml; 
    @endphp --}}

<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav_0" role="tabpanel" aria-labelledby="nav_tab_0">
        @include('ModuleNtue.NewStudent.RegClass.view1')
    </div>
    <div class="tab-pane fade" id="nav_1" role="tabpanel" aria-labelledby="nav_tab_1">
        @include('ModuleNtue.NewStudent.RegClass.view2')
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