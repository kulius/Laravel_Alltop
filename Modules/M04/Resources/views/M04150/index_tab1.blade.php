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
    $sHtml.= $eZui->setGroup(array("body" => $aBody));

    $aBody   = array();
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnSubmit(array("ex" => "search")));
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array('ex' => 'add',"text" => _("新增公告"), "style" => "so")));
    $sHtml.= $eZui->setGroup(array("body" => $aBody));

    $aBody   = array();
    $aBody[] = array("flex"=>5,"body" => $eZui->setComboBox(array( "name" => "", "value" => '', "option" =>'', "select" => false)));
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("text" => _("Email通知"), "style" => "so")));
    $sGroup = $eZui->setGroup(array("body" => $aBody));

    $aBody   = array();
    $aBody[] = array("head" => _("Email範本選擇兼發送通知"), "body" => $sGroup);
    $sHtml.= $eZui->setGroup(array("body" => $aBody));

    $aField   = array();
    $aField[] = array("head" => _("學年"), "name" => "aa", "width" => "20%");
    $aField[] = array("head" => _("學期"), "name" => "bb", "width" => "20%");
    $aField[] = array("head" => _("問卷名稱"), "name" => "cc", "width" => "20%");
    $aField[] = array("head" => _("群組"), "name" => "dd", "width" => "20%");
    $aField[] = array("head" => _("問卷填寫時間起迄"), "name" => "ee", "width" => "20%");
    $aField[] = array("head" => _("是否同步發送Email"), "name" => "ff", "width" => "20%");

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
        $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "m04150_tab1_view", "param" => array("view")));
        $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "m04150_tab1_view", "param" => array("edit")));
        $aData[$skData]["btn"]    = implode("", $aBtn);
	}

    $aSet = array(
        "field"  => $aField,
        "data"   => $aData,
    );

    $sHtml .= $eZui->setGridMUL($aSet);

    $aParams =  array(
                    'aTabInfo' => array(
                        'm04150' => array('param' =>'','title'=>'新增公告','view' => $sHtml, 'current' => 'active'),
                        'm04150_tab2' => array('param' =>'','title'=>'發送紀錄'),
                        'm04150_tab3' => array('param' =>'','title'=>'問卷設計'),
                        'm04150_tab4' => array('param' =>'','title'=>'公告範本'),
                        )
                );

    $sHtml = $eZui->setTab($aParams);

	@endphp
    {!! $sHtml !!}
    {!! $eZui->setValidata('main') !!}
    </form>
@endsection
