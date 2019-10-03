@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')

@include('layouts.error_tips', array('errors' => $errors))

    <form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
	@php
    $sHtml = null;


    $aBody   = array();
    $aBody[] = array("head" => _("題目"), "flex" => "12", "body" => $eZui->setFont(array("text" => _("請問您最常用哪種瀏覽器登入此系統?"))));
    $sHtml.= $eZui->setGroup(array("body" => $aBody));

    $aBody   = array();
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnSubmit(array("ex" => "search")));
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'm04120_tab2_view', 'param' => array('add'))));
    $sHtml.= $eZui->setGroup(array("body" => $aBody));


    $aField   = array();
    $aField[] = array("head" => _("項目編號"), "name" => "aa", "width" => "20%");
    $aField[] = array("head" => _("項目名稱"), "name" => "bb", "width" => "20%");
    $aField[] = array("head" => _("功能"), "name" => "btn");


    $aData = array();
    foreach ($data as $skData => $svData) {
        $aData[$skData]["aa"]         = trim($svData["aa"]);
        $aData[$skData]["bb"]         = trim($svData["bb"]);
        
        $aBtn   = array();
        $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "m04120_tab2_view", "param" => array("view")));
        $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "m04120_tab2_view", "param" => array("edit")));       
        $aData[$skData]["btn"]    = implode("", $aBtn);
	}

    $aSet = array(
        "field"  => $aField,
        "data"   => $aData,
        "btn"    =>array("remove")
    );

    $sHtml .= $eZui->setGridMUL($aSet);
    $aParams =  array(
                    'aTabInfo' => array(
                        'm041120_tab1' => array('param' =>'','title'=>'題目資訊'),
                        'm04120_tab2' => array('param' =>'','title'=>'選項','view' => $sHtml, 'current' => 'active'),
                        )
                );

    $sHtml = $eZui->setTab($aParams);


	@endphp
    {!! $sHtml !!}
    {!! $eZui->setValidata('main') !!}
    </form>
@endsection
