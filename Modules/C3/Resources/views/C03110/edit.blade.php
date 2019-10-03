@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form method='POST' id='index'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody   = array();
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnClass(array("ex" => "save", "value" => "save")));
    $sGetParam = null;
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnHref(array("ex" => "leave", 'route' => 'c03110', 'param' => array($sGetParam))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

	$aBody   = array();
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('學年'), 'name' => 'drop1', 'value' => '', 'option' => '', 'req' => false, 'def' => '-')));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('學期'), 'name' => 'drop2', 'value' => '', 'option' => '', 'req' => false, 'def' => '-')));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('部別'), 'name' => 'drop3', 'value' => '', 'option' => '', 'req' => false, 'def' => '-')));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('學制'), 'name' => 'drop4', 'value' => '', 'option' => '', 'req' => false, 'def' => '-')));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array("body" => $eZui->setDateBox(array("head" => _("問卷開始日期"), "name" => "date", "value" => "")));
    $aBody[] = array("body" => $eZui->setDateBox(array("head" => _("問卷結束日期"), "name" => "date", "value" => "")));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    echo $sHtml;
    @endphp
    {!! $eZui->setValidata('index') !!}
    </form>
@endsection
