@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody = array();
    $aBody[] = array("flex" => '12', "body" => $eZui->setEditArea(array("name" => "EditArea", "value" => '')));
    $aBody[] = array("flex" => 'auto', "body" => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aMemo   = array();
    $aMemo[] = _("備註");
    $aMemo[] = _("1. 設定尚未開放借教室時，顯示的文字");
    //b->blue, g->green, r->red, y->yellow, i->light-green,d,s,l
    $sHtml .= $eZui->setAlert(array("text" => $aMemo, "style" => "r"));
    //echo $sHtml;
    @endphp
        {!! $sHtml !!}
        {!! $eZui->setValidata('main') !!}
</form>
@endsection
