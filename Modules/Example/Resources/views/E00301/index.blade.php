@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')


@section('content')

  {{--  @php
    $sHtml = null;

    $aNavs = array();
    $aNavs[] = array("head" => _("班級資料維護"), "body" => '', 'route' => 'regClass_view1');
    $aNavs[] = array("head" => _("學期班級資料維護"), "body" => '','route' => 'regClass_view2' );

    $sHtml .= $eZui->setNavs($aNavs);

     echo $sHtml;
    @endphp --}}

<ul class="nav nav-tabs mb-3" id="tabs" role="tablist">
    <li><a class="nav-item nav-link active" id="nav_tab_0" data-toggle="tab" href="{{ route('home') }}" role="tab" aria-controls="nav_0" aria-selected="true">班級資料維護</a></li>
    <li><a class="nav-item nav-link" id="nav_tab_1" data-toggle="tab" href="#nav_1" role="tab" aria-controls="nav_1" aria-selected="false">學期班級資料維護</a></li>
</ul>

{{-- <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav_0" role="tabpanel" aria-labelledby="nav_tab_0">
         @include('example::E00301.index_view1') 
    </div>
    <div class="tab-pane fade" id="nav_1" role="tabpanel" aria-labelledby="nav_tab_1">
        @include('example::E00301.index_view2')
    </div>
</div> --}}
<div id="tabs-1">
    asdsad
</div>
<script>
  $( function() {
    $( "#tabs" ).tabs({
      beforeLoad: function( event, ui ) {
        ui.jqXHR.fail(function() {
          ui.panel.html(
            "Couldn't load this tab. We'll try to fix this as soon as possible. " +
            "If this wouldn't be a demo." );
        });
      }
    });
  } );
</script>
@endsection
