@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')

@include('layouts.error_tips', array('errors' => $errors))

    <form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
	@php
    $sHtml = null;


    $aBody   = array();
    $aBody[] = array("flex"=>3,"body" => $eZui->setComboBox(array("name" => "", "value" => '', "option" =>'', "select" => false)));
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array('ex' => 'add',"text" => _("加入題目"), "style" => "so")));

    $sGroup = $eZui->setGroup(array("body" => $aBody));

    $aBody   = array();
    $aBody[] = array("head" => _("是否同步發送公告兼範本選擇"), "body" => $sGroup);
    $sHtml .= $eZui->setGroup(array("body" => $aBody));

    $aBody   = array();
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'm04150_Ttab3_view', 'param' => array('add'))));
    $sHtml.= $eZui->setGroup(array("body" => $aBody));
;

    $aField   = array();
    $aField[] = array("head" => _("編號"), "name" => "aa", "width" => "20%");
    $aField[] = array("head" => _("題目類型"), "name" => "bb", "width" => "20%");
    $aField[] = array("head" => _("題目"), "name" => "cc", "width" => "20%");
    $aField[] = array("head" => _("選項"), "name" => "dd", "width" => "20%");


    $aData = array();
    foreach ($data as $skData => $svData) {
        $aData[$skData]["aa"]         = trim($svData["aa"]);
        $aData[$skData]["bb"]         = trim($svData["bb"]);
        $aData[$skData]["cc"]         = trim($svData["cc"]);
        $aData[$skData]["dd"]         = trim($svData["dd"]);

	}

    $aSet = array(
        "field"  => $aField,
        "data"   => $aData,
        "btn"    =>array("remove")
    );

    $sHtml .= $eZui->setGridMUL($aSet);

    
    $aParams =  array(
                    'aTabInfo' => array(
                        'm04150_tab31' => array('param' =>'','title'=>'問卷資料'),
                        'm04150_tab32' => array('param' =>'','title'=>'題目設定','view' => $sHtml, 'current' => 'active'),
                        )
                );

            $aBody   = array();
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm04150_tab3')));
            $sHtml= $eZui->setGroup(array("body" => $aBody));

    $sHtml .= $eZui->setTab($aParams);

	@endphp
    {!! $sHtml !!}
    {!! $eZui->setValidata('main') !!}
    </form>
@endsection
