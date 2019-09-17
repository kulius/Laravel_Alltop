@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form method='POST'>
    {{ csrf_field() }}
	@php
    $sHtml = null;

    $aBody   = array();
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'a01120_view', 'param' => array('add'))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aField   = array();
    $aField[] = array("head" => _("狀態"), "name" => "state", "width" => "10%", "align" => "center");
    $aField[] = array("head" => _("部別代碼"), "name" => "Dayfg", "width" => "10%", "align" => "center");
    $aField[] = array("head" => _("部別中文"), "name" => "DayfgName", "width" => "20%");
    $aField[] = array("head" => _("部別英文"), "name" => "DayfgENGName", "width" => "20%");
    $aField[] = array("head" => _("部別簡稱"), "name" => "DayfgAlias", "width" => "20%");
    $aField[] = array("head" => _("功能"), "name" => "btn", "align" => "right");

    $aData = array();
    foreach ($data as $skData => $svData) {
        $sDayfgID      = trim($svData["DayfgID"]);
        $sDayfg        = trim($svData["Dayfg"]);
        $sDayfgName    = trim($svData["DayfgName"]);
        $sDayfgENGName = trim($svData["DayfgENGName"]);
        $sDayfgAlias   = trim($svData["DayfgAlias"]);
        $sState        = trim($svData["state"]) == '0' ? $eZui->setFont(array("text" => _("停用"), "style" => "r")) : _("使用中");

        $aBtn   = array();
        $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "a01120_view", "param" => array("view", $sDayfgID)));
        $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "a01120_view", "param" => array("edit", $sDayfgID)));

        //隱藏（KEY）
        $aData[$skData]["DayfgID"] = $sDayfgID;

        //顯示
        $aData[$skData]["state"]        = $sState;
        $aData[$skData]["Dayfg"]        = $sDayfg;
        $aData[$skData]["DayfgName"]    = $sDayfgName;
        $aData[$skData]["DayfgENGName"] = $sDayfgENGName;
        $aData[$skData]["DayfgAlias"]   = $sDayfgAlias;
        $aData[$skData]["btn"]          = implode("", $aBtn);
    }

    $aSet = array(
        "field" => $aField,
        "data"  => $aData,
        "btn"   => array("remove"),
    );
    $sHtml .= $eZui->setGridMUL($aSet);

    $aMemo   = array();
    $aMemo[] = $eZui->setFont(array("text" => _("備註："), "style" => "r"));
    $aMemo[] = _("1. 【高】：高教司 (大學校院校務資料庫)");
    $sHtml .= $eZui->setAlert(array("text" => $aMemo, "style" => "y"));

    echo $sHtml;
	@endphp
    </form>
@endsection
