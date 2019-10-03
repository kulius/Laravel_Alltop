@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.frame_modal')

@section('content')
    <form method='POST' id='index'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

	$aBody   = array();
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('學習策略'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '-')));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    // ----- Grid 要顯示的欄位 -----
    $aField   = array();
    $aField[] = array("head" => _("學習策略"), "name" => "FieldName1", "width" => "30%", "align" => "center");
    $aField[] = array("head" => _("題目內容"), "name" => "FieldName2", "width" => "70%", "align" => "center");

    // 擷取要輸出到 Grid 的 Model 資料
    $aData = array();
    foreach ($data as $skData => $svData) {
        //隱藏（KEY）
        $aData[$skData]["FieldID"] = trim($svData["FieldID"]);

        //顯示
        $aData[$skData]["FieldName1"]         = trim($svData["FieldName1"]);
        $aData[$skData]["FieldName2"]         = trim($svData["FieldName2"]);

        $aBtn   = array();
        $aData[$skData]["btn"] = '';
    }

    // fake data
    $aData[0]["FieldName1"] = '認知監控';
    $aData[0]["FieldName2"] = '學習時，我會檢視自己對於書本內容的理解程度。';

    $aBtn   = array();
    $aData[0]["btn"] = '';

    $aSet = array(
        "field" => $aField,
        "data"  => $aData,
        "btn"   => array("select"),
    );
    $sHtml .= $eZui->setGridMUL($aSet);

    echo $sHtml;
    @endphp
    {!! $eZui->setValidata('index') !!}
    </form>
@endsection
