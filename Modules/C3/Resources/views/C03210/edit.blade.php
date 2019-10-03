@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form method='POST' id='index'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody   = array();
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnClass(array("ex" => "save", "value" => "save")));
    $sGetParam = null;
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnHref(array("ex" => "leave", 'route' => 'c03210', 'param' => array($sGetParam))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array("head" => _("學年"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("109"), "size" => "1.0")));
    $aBody[] = array("head" => _("學期"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("第2學期"), "size" => "1.0")));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

	$aBody   = array();
    $aBody[] = array('flex' => '4', 'body' => $eZui->setTextBox(array('head' => __('問卷名稱'), 'name' => 'text', 'value' => old('text') )));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

	$aBody   = array();
	$aBody[] = array("flex" => "auto", "body" => $eZui->setJump(array('ex' => 'add', 'text' => '新增題目', "url" => "c03210_add_jump", "param" => array("head" => "新增題目", 'urlParam' => 'rpt'))) );
   	$sHtml .= $eZui->setGroup(array('body' => $aBody));

    // ----- Grid 要顯示的欄位 -----
    $aField   = array();
    $aField[] = array("head" => _("題目編號"), "name" => "FieldName1", "width" => "33%", "align" => "center");
    $aField[] = array("head" => _("學習策略"), "name" => "FieldName2", "width" => "33%", "align" => "center");
    $aField[] = array("head" => _("題目內容"), "name" => "FieldName3", "width" => "33%", "align" => "center");

    // 擷取要輸出到 Grid 的 Model 資料
    $aData = array();
    foreach ($data as $skData => $svData) {
        //隱藏（KEY）
        $aData[$skData]["FieldID"] = trim($svData["FieldID"]);
        //顯示
        $aData[$skData]["FieldName1"]         = trim($svData["FieldName1"]);
        $aData[$skData]["FieldName2"]         = trim($svData["FieldName2"]);
        $aData[$skData]["FieldName3"]         = trim($svData["FieldName3"]);

        $aBtn   = array();
        $aData[$skData]["btn"] = '';
    }

    $aData[0]["FieldName1"] = '1';
    $aData[0]["FieldName2"] = '認知監控';
    $aData[0]["FieldName3"] = '學習時，我會檢視自己對於書本內容的理解程度。';
    $aBtn   = array();
    $aData[0]["btn"] = '';

    $aSet = array(
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
