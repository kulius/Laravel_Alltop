@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form method='POST' id='index'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody   = array();
    $sGetParam = null;
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnHref(array("ex" => "leave", 'route' => 'c03240_index_std', 'param' => array($sGetParam))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    // ----- Grid 要顯示的欄位 -----
    $aField   = array();
    $aField[] = array("head" => _("題號"), "name" => "FieldName1", "width" => "20%", "align" => "center");
    $aField[] = array("head" => _("題目"), "name" => "FieldName2", "width" => "60%", "align" => "center");
    $aField[] = array("head" => _("答案名稱"), "name" => "FieldName3", "width" => "20%", "align" => "center");

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
        $aData[$skData]["btn"] = implode("", $aBtn);
    }

    // fake data
    for($i = 0; $i <= 10; $i++)
    {
        $aData[$i]["FieldName1"] = $i;
        $aData[$i]["FieldName2"] = '學習時，我會檢視自己對於書本內容的理解程度。';
        $aData[$i]["FieldName3"] = '非常滿意';
        $aBtn   = array();
        $aData[$i]["btn"] = implode("", $aBtn);
    }

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
