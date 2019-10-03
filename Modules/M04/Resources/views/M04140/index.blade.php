@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form method='POST' id='index'>
    {{ csrf_field() }}
	@php
    $sHtml = null;

    $aBody   = array();
    $aBody[] = array("body" => $eZui->setTextBox(array("head" => _("題目名稱"), "name" => "text", "value" => "")));
    $sHtml.= $eZui->setGroup(array("body" => $aBody));

    $aBody   = array();
    $aBody[] = array("body" => $eZui->setDateBox(array( "name" => "date", "value" => "")));
    $aBody[] = array( "flex" => "1", "body" => $eZui->setFont(array("text" => _("~"))));
    $aBody[] = array("body" => $eZui->setDateBox(array( "name" => "date", "value" => "")));
    $sGroup = $eZui->setGroup(array("body" => $aBody));

    $aBody   = array();
    $aBody[] = array("head" => _("建立時間範圍"), "body" => $sGroup);
    $sHtml.= $eZui->setGroup(array("body" => $aBody));

    $aBody   = array();
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnSubmit(array("ex" => "search")));
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'm04140_view1', 'param' => array('add'))));
    $sHtml.= $eZui->setGroup(array("body" => $aBody));

    $aField   = array();
    $aField[] = array("head" => _("題庫名稱"), "name" => "aa", "width" => "20%");
    $aField[] = array("head" => _("題目數量"), "name" => "bb", "width" => "20%");
    $aField[] = array("head" => _("建立時間"), "name" => "cc", "width" => "20%");
    $aField[] = array("head" => _("異動時間"), "name" => "dd", "width" => "20%");
    $aField[] = array("head" => _("異動人員"), "name" => "ee", "width" => "20%");

    $aField[] = array("head" => _("功能"), "name" => "btn");

    $aData = array();
    foreach ($data as $skData => $svData) {
        $aData[$skData]["aa"]         = trim($svData["aa"]);
        $aData[$skData]["bb"]         = trim($svData["bb"]);
        $aData[$skData]["cc"]         = trim($svData["cc"]);
        $aData[$skData]["dd"]         = trim($svData["dd"]);
        $aData[$skData]["ee"]         = trim($svData["ee"]);

        $aBtn   = array();
        $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "m04140_view2", "param" => array("view")));
        $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "m04140_view2", "param" => array("edit")));
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
