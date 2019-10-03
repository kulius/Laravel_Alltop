@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form method='POST' id='index'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody   = array();
    $sGetParam = null;
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnHref(array("ex" => "leave", 'route' => 'c03110', 'param' => array($sGetParam))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

	$aBody   = array();
    $aBody[] = array("head" => _("學年"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("FontContent"), "size" => "1.0")));
    $aBody[] = array("head" => _("學期"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("FontContent"), "size" => "1.0")));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array("head" => _("部別"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("FontContent"), "size" => "1.0")));
    $aBody[] = array("head" => _("學制"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("FontContent"), "size" => "1.0")));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array("head" => _("問卷開始日期"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("FontContent"), "size" => "1.0")));
    $aBody[] = array("head" => _("問卷結束日期"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("FontContent"), "size" => "1.0")));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    echo $sHtml;
    @endphp
    {!! $eZui->setValidata('index') !!}
    </form>
@endsection
