@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form method='POST' id='index'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

	$aBody   = array();
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('學年'), 'name' => 'drop1', 'value' => '', 'option' => '', 'req' => false, 'def' => '-')));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('學期'), 'name' => 'drop2', 'value' => '', 'option' => '', 'req' => false, 'def' => '-')));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'search')));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    // ----- Grid 要顯示的欄位 -----
    $aField   = array();
    $aField[] = array("head" => _("功能"), "name" => "btn", "align" => "right");
    $aField[] = array("head" => _("學年"), "name" => "FieldName1", "width" => "33%", "align" => "center");
    $aField[] = array("head" => _("學期"), "name" => "FieldName2", "width" => "33%", "align" => "center");
    $aField[] = array("head" => _("問卷名稱"), "name" => "FieldName3", "width" => "33%", "align" => "center");

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
        $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "c03240_index_std_view", "param" => array("view", trim($svData["FieldID"]))));
        $aData[$skData]["btn"] = implode("", $aBtn);
    }

    // fake data
    for($i = 0; $i <= 5; $i++)
    {
        $aData[$i]["FieldName1"] = 'Test Data';
        $aData[$i]["FieldName2"] = 'Test Data';
        $aData[$i]["FieldName3"] = 'Test Data';
        $aBtn   = array();
        $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "c03240_index_std_view", "param" => array("view", '')));
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
