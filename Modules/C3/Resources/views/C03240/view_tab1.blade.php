@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form method='POST' id='index'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody   = array();
    $sGetParam = null;
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnHref(array("ex" => "leave", 'route' => 'c03240', 'param' => array($sGetParam))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $sTabHtml = null;
	$aBody   = array();

    $aBody[] = array("head" => _("問卷學年"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("FontContent"), "size" => "1.0")));
    $aBody[] = array("head" => _("問卷學期"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("FontContent"), "size" => "1.0")));
    $aBody[] = array("head" => _("問卷名稱"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("FontContent"), "size" => "1.0")));

    // TODO : 能力分布圖

	$sTabHtml .= $eZui->setGroup(array('body' => $aBody));

    $aParams =  array(
                'aTabInfo' => array(
                    'c03240_view_tab1' => array('title'=>'學期總平均', 'view' => $sTabHtml, 'current' => 'active'),
                    'c03240_view_tab2' => array('title'=>'學習策略系所總表'),
                )
            );
	$sHtml .= $eZui->setTab($aParams);

	$aBody   = array();
    $sGetParam = null;
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnHref(array("ex" => "leave", 'route' => 'c03240', 'param' => array($sGetParam))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    echo $sHtml;
    @endphp
    {!! $eZui->setValidata('index') !!}
    </form>
@endsection
