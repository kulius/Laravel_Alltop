@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

	$aBody   = array();



    $aBody   = array();
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('學年'), "name" => "srh[ACADYear]",
    "value" => $sYear, "option" => $aYearOp,"select" => false,"def" => _("請選擇") , 'attr' => array("onchange=form.submit()"))));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('學期'), 'name' => "srh[Semester]",
    "value" => $sSem, "option" => $aSemOp, "select" => false,"def" => _("請選擇") , 'attr' => array("onchange=form.submit()"))));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('部別'), 'name' => "srh[DayfgID]",
    "value" => $sDayfgID, "option" => $aDfgOp,"select" => false,"def" => _("請選擇") , 'attr' => array("onchange=form.submit()"))));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('學制'), 'name' => "srh[ClassTypeID]",
    "value" => $sClassTypeID,"option" => $aClassTypeOp,"select" => false,"def" => _("請選擇") , 'attr' => array("onchange=form.submit()"))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'search')));
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'c03110_add', 'param' => array('add'))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    // ----- Grid 要顯示的欄位 -----
    $aField   = array();
    $aField[] = array("head" => _("功能"), "name" => "btn", "align" => "right");
    $aField[] = array("head" => _("學年"), "name" => "FieldName1", "width" => "15%", "align" => "center");
    $aField[] = array("head" => _("學期"), "name" => "FieldName2", "width" => "15%", "align" => "center");
    $aField[] = array("head" => _("部別"), "name" => "FieldName3", "width" => "15%", "align" => "center");
    $aField[] = array("head" => _("學制"), "name" => "FieldName4", "width" => "15%", "align" => "center");
    $aField[] = array("head" => _("問卷開放日期"), "name" => "FieldName5", "width" => "15%", "align" => "center");
    $aField[] = array("head" => _("問卷結束時間"), "name" => "FieldName6", "width" => "15%", "align" => "center");

    // 擷取要輸出到 Grid 的 Model 資料
    $aData = array();
    foreach ($data as $skData => $svData) {
        //隱藏（KEY）
        $aData[$skData]["FieldID"] = trim($svData["FieldID"]);

        //顯示
        $aData[$skData]["FieldName1"]         = trim($svData["FieldName1"]);
        $aData[$skData]["FieldName2"]         = trim($svData["FieldName2"]);
        $aData[$skData]["FieldName3"]         = trim($svData["FieldName3"]);
        $aData[$skData]["FieldName4"]         = trim($svData["FieldName4"]);
        $aData[$skData]["FieldName5"]         = trim($svData["FieldName5"]);
        $aData[$skData]["FieldName6"]         = trim($svData["FieldName6"]);

        $aBtn   = array();
        $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "c03110_view", "param" => array("view", trim($svData["FieldID"]))));
        $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "c03110_edit", "param" => array("edit", trim($svData["FieldID"]))));
        $aData[$skData]["btn"] = implode("", $aBtn);
    }

    $aData[0]["FieldName1"] = 'test';
    $aData[0]["FieldName2"] = 'test';
    $aData[0]["FieldName3"] = 'test';
    $aData[0]["FieldName4"] = 'test';
    $aData[0]["FieldName5"] = 'test';
    $aData[0]["FieldName6"] = 'test';
    $aBtn   = array();
    $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "c03110_view", "param" => array("view", '')));
    $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "c03110_edit", "param" => array("edit", '')));
    $aData[0]["btn"] = implode("", $aBtn);

    $aSet = array(
        "id"=>"c03110",
        "field" => $aField,
        "data"  => $aData,
        "btn"   => array("remove"),
    );
    $sHtml .= $eZui->setGridMUL($aSet);

    echo $sHtml;
    @endphp
    {!! $eZui->setValidata('index') !!}
    </form>
@endsection
