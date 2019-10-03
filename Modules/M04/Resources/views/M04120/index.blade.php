@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form method='POST' id='index'>
    {{ csrf_field() }}
	@php
    $sHtml = null;

    $aBody   = array();
    $aBody[] = array("flex"=>3,"body" => $eZui->setComboBox(array("head" => _("試題類型"), "name" => "", "value" => '', "option" =>'', "select" => false)));
    $sHtml.= $eZui->setGroup(array("body" => $aBody));
 
    $aBody   = array();
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnSubmit(array("ex" => "search")));
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'm04120_tab1', 'param' => array('add'))));
    $sHtml.= $eZui->setGroup(array("body" => $aBody));


    $aField   = array();
    $aField[] = array("head" => _("試題類型"), "name" => "aa", "width" => "20%");
    $aField[] = array("head" => _("題目名稱"), "name" => "bb", "width" => "20%");
    $aField[] = array("head" => _("功能"), "name" => "btn");

    $aData = array();
    foreach ($data as $skData => $svData) {
        $aData[$skData]["aa"]         = trim($svData["aa"]);
        $aData[$skData]["bb"]         = trim($svData["bb"]);

        $aBtn   = array();
        $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "m04120_tab1", "param" => array("view")));
        $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "m04120_tab1", "param" => array("edit")));
        $aData[$skData]["btn"]    = implode("", $aBtn);
	}

    $aSet = array(
        "field"  => $aField,
        "data"   => $aData,
        "btn"    =>array("remove")
    );

    $sHtml .= $eZui->setGridMUL($aSet);

    echo $sHtml;
	@endphp
    {!! $eZui->setValidata('index') !!}
    </form>
@endsection
