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
    $aBody[] = array("flex"=>3,"body" => $eZui->setComboBox(array("head" => _("部別"), "name" => "", "value" => '', "option" =>'', "select" => false)));
    $aBody[] = array("flex"=>3,"body" => $eZui->setComboBox(array("head" => _("學制"), "name" => "", "value" => '', "option" =>'', "select" => false)));
    $aBody[] = array("flex"=>3,"body" => $eZui->setComboBox(array("head" => _("學院"), "name" => "", "value" => '', "option" =>'', "select" => false)));
    $aBody[] = array("flex"=>3,"body" => $eZui->setComboBox(array("head" => _("系所"), "name" => "", "value" => '', "option" =>'', "select" => false)));
    $aBody[] = array("flex"=>3,"body" => $eZui->setComboBox(array("head" => _("組別"), "name" => "", "value" => '', "option" =>'', "select" => false)));
    $aBody[] = array("flex"=>3,"body" => $eZui->setComboBox(array("head" => _("年級"), "name" => "", "value" => '', "option" =>'', "select" => False)));
    $aBody[] = array("flex"=>3,"body" => $eZui->setComboBox(array("head" => _("班級"), "name" => "", "value" => '', "option" =>'', "select" => false)));
    $aBody[] = array("flex"=>3,"body" => $eZui->setComboBox(array("head" => _("批號"), "name" => "", "value" => '', "option" =>'', "select" => false)));
    $aBody[] = array("flex"=>3,"body" => $eZui->setTextBox(array("head" => _("學號/姓名(包含職員)"), "name" => "text", "value" => "")));
    $aBody[] = array("flex"=>3,"body" => $eZui->setComboBox(array("head" => _("群組"), "name" => "", "value" => '', "option" =>'', "select" => false)));
    $sHtml.= $eZui->setGroup(array("body" => $aBody));

    $aBody   = array();
    $aBody[] = array("body" => $eZui->setDateBox(array("name" => "date", "value" => "")));
    $aBody[] = array("flex" => "0.5", "body" => $eZui->setFont(array("text" => _("~"))));
    $aBody[] = array("body" => $eZui->setDateBox(array("name" => "date", "value" => "")));
    $sGroup = $eZui->setGroup(array("body" => $aBody));

    $aBody   = array();
    $aBody[] = array("head" => _("發送時間範圍"), "body" => $sGroup);
    $sHtml.= $eZui->setGroup(array("body" => $aBody));

    $aBody   = array();
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnSubmit(array("ex" => "search")));
    $sHtml.= $eZui->setGroup(array("body" => $aBody));
;

    $aField   = array();
    $aField[] = array("head" => _("學年"), "name" => "aa", "width" => "20%");
    $aField[] = array("head" => _("學期"), "name" => "bb", "width" => "20%");
    $aField[] = array("head" => _("部別"), "name" => "cc", "width" => "20%");
    $aField[] = array("head" => _("學制"), "name" => "dd", "width" => "20%");
    $aField[] = array("head" => _("班級"), "name" => "ee", "width" => "20%");
    $aField[] = array("head" => _("學號"), "name" => "ff", "width" => "20%");
    $aField[] = array("head" => _("姓名"), "name" => "gg", "width" => "20%");
    $aField[] = array("head" => _("群組"), "name" => "hh", "width" => "20%");
    $aField[] = array("head" => _("發送時間"), "name" => "ii", "width" => "20%");
    $aField[] = array("head" => _("發送狀態"), "name" => "jj", "width" => "20%");

    $aData = array();
    foreach ($data as $skData => $svData) {
        $aData[$skData]["aa"]         = trim($svData["aa"]);
        $aData[$skData]["bb"]         = trim($svData["bb"]);
        $aData[$skData]["cc"]         = trim($svData["cc"]);
        $aData[$skData]["dd"]         = trim($svData["dd"]);
        $aData[$skData]["ee"]         = trim($svData["ee"]);
        $aData[$skData]["ff"]         = trim($svData["ff"]);
        $aData[$skData]["gg"]         = trim($svData["gg"]);
        $aData[$skData]["hh"]         = trim($svData["hh"]);
        $aData[$skData]["ii"]         = trim($svData["ii"]);
        $aData[$skData]["jj"]         = trim($svData["jj"]);
	}

    $aSet = array(
        "field"  => $aField,
        "data"   => $aData,
    );

    $sHtml .= $eZui->setGrid($aSet);

    
    $aParams =  array(
                    'aTabInfo' => array(
                        'm04150' => array('param' =>'','title'=>'新增公告'),
                        'm04150_tab2' => array('param' =>'','title'=>'發送紀錄','view' => $sHtml, 'current' => 'active'),
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
