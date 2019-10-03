@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')

@include('layouts.error_tips', array('errors' => $errors))

    <form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
	@php
    $sHtml = null;

    $aBody   = array();
    $aBody[] = array("flex"=>3,"body" => $eZui->setComboBox(array("head" => _("學年"), "name" => "", "value" => '', "option" =>'', "select" => false)));
    $aBody[] = array("flex"=>3,"body" => $eZui->setComboBox(array("head" => _("學期"), "name" => "", "value" => '', "option" =>'', "select" => false)));
    $aBody[] = array("flex"=>3,"body" => $eZui->setComboBox(array("head" => _("群組"), "name" => "", "value" => '', "option" =>'', "select" => false)));
    $aBody[] = array("flex"=>3,"body" => $eZui->setTextBox(array("head" => _("問卷名稱/編號"), "name" => "text", "value" => "")));
    $sHtml.= $eZui->setGroup(array("body" => $aBody));

    $aBody   = array();
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnSubmit(array("ex" => "search")));
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'm04150_Ttab3_view', 'param' => array('add'))));
    $sHtml.= $eZui->setGroup(array("body" => $aBody));
;

    $aField   = array();
    $aField[] = array("head" => _("學年"), "name" => "aa", "width" => "20%");
    $aField[] = array("head" => _("學期"), "name" => "bb", "width" => "20%");
    $aField[] = array("head" => _("問卷編號"), "name" => "cc", "width" => "20%");
    $aField[] = array("head" => _("問卷名稱"), "name" => "dd", "width" => "20%");
    $aField[] = array("head" => _("調查對象"), "name" => "ee", "width" => "20%");
    $aField[] = array("head" => _("題數"), "name" => "ff", "width" => "20%");
    $aField[] = array("head" => _("功能"), "name" => "btn");

    $aData = array();
    foreach ($data as $skData => $svData) {
        $aData[$skData]["aa"]         = trim($svData["aa"]);
        $aData[$skData]["bb"]         = trim($svData["bb"]);
        $aData[$skData]["cc"]         = trim($svData["cc"]);
        $aData[$skData]["dd"]         = trim($svData["dd"]);
        $aData[$skData]["ee"]         = trim($svData["ee"]);
        $aData[$skData]["ff"]         = trim($svData["ff"]);
        
        $aBtn   = array();
        $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "m04150_tab31", "param" => array("view")));
        $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "m04150_tab31", "param" => array("edit")));
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
                        'm04150' => array('param' =>'','title'=>'新增公告'),
                        'm04150_tab2' => array('param' =>'','title'=>'發送紀錄'),
                        'm04150_tab3' => array('param' =>'','title'=>'問卷設計','view' => $sHtml, 'current' => 'active'),
                        'm04150_tab4' => array('param' =>'','title'=>'公告範本'),
                        )
                );

    $sHtml = $eZui->setTab($aParams);

	@endphp
    {!! $sHtml !!}
    {!! $eZui->setValidata('main') !!}
    </form>
@endsection
