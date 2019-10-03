@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form method='POST' id='index'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody   = array();
    $sGetParam = null;
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnHref(array("ex" => "leave", 'route' => 'c03120', 'param' => array($sGetParam))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

	$aBody   = array();
    $aBody[] = array("head" => _("學習策略"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("FontContent"), "size" => "1.0")));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

	$aBody   = array();
	$aBody[] = array("flex" => "auto", "body" => $eZui->setJump(array('ex' => 'add', 'text' => '新增選項', "url" => "c03120_add_jump", "param" => array("head" => "新增選項", 'urlParam' => 'rpt'))) );
   	$sHtml .= $eZui->setGroup(array('body' => $aBody));

    // ----- Grid 要顯示的欄位 -----
    $aField   = array();
    $aField[] = array("head" => _("項目編號"), "name" => "FieldName1", "width" => "50%", "align" => "center");
    $aField[] = array("head" => _("項目名稱"), "name" => "FieldName2", "width" => "50%", "align" => "center");

    // 擷取要輸出到 Grid 的 Model 資料
    $aData = array();
    foreach ($data as $skData => $svData) {
        //隱藏（KEY）
        $aData[$skData]["FieldID"] = trim($svData["FieldID"]);
        //顯示
        $aData[$skData]["FieldName1"]         = trim($svData["FieldName1"]);
        $aData[$skData]["FieldName2"]         = trim($svData["FieldName2"]);
    }

    $aData[0]["FieldName1"] = 'test';
    $aData[0]["FieldName2"] = 'test';
    $aBtn   = array();
    $aData[0]["btn"] = '';

    $aSet = array(
        "field" => $aField,
        "data"  => $aData,
    );
    $sHtml .= $eZui->setGrid($aSet);

    echo $sHtml;
    @endphp
    {!! $eZui->setValidata('index') !!}
    </form>
@endsection
