@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody=array();
    $aBody[] = array("flex" => "6", "body" => $eZui->setFont(array("text" => _("教室借用明細一覽表"), "size" => "1.5")));
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnSubmit(array('ex'=>'print','value'=>'print')));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));


    $aBody=array();
    $aBody[] = array("flex" => "6", "body" => $eZui->setFont(array("text" => _("列印教室使用狀況"), "size" => "1.5")));
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnSubmit(array('ex'=>'print','value'=>'print')));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));




    @endphp
        {!! $sHtml !!}
        {!! $eZui->setValidata('main') !!}
</form>
@endsection
