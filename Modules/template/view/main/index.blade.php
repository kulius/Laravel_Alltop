@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form method='POST' id='index'>
    {{ csrf_field() }}
	@php
    $sHtml = null;

    // ----- 下拉查詢條件 -----
    $aOption = array();
    $aBody   = array();
    $aBody[] = array("flex" => 4, "body" => $eZui->setComboBox(array("head" => _("ComboBox1_srh"), "name" => "Combo_name1_srh", "value" => old("Combo_name1_srh"), "option" => $aOption, "select" => false)));
    $aBody[] = array("flex" => 4, "body" => $eZui->setComboBox(array("head" => _("ComboBox2_srh"), "name" => "Combo_name2_srh", "value" => old("Combo_name2_srh"), "option" => $aOption, "select" => false)));
    $sHtml .= $eZui->setGroup(array("body" => $aBody));

    // ----- 輸入查詢條件 -----
    $aBody   = array();
    $aBody[] = array("flex" => 4, "body" => $eZui->setTextBox(array("head" => _("TextBox1_srh"), "name" => "TextBox1_srh", "value" => old("TextBox1_srh"))));
    $aBody[] = array("flex" => 4, "body" => $eZui->setTextBox(array("head" => _("TextBox2_srh"), "name" => "TextBox2_srh", "value" => old("TextBox2_srh"))));
    $sHtml .= $eZui->setGroup(array("body" => $aBody));

    // ----- 查詢,新增按鈕 -----
    $aBody   = array();
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'search')));
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'e01110_view', 'param' => array('add'))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    // ----- Grid 要顯示的欄位 -----
    $aField   = array();
    $aField[] = array("head" => _("Field1"), "name" => "FieldName1", "width" => "10%", "align" => "center");
    $aField[] = array("head" => _("Field2"), "name" => "FieldName2", "width" => "10%", "align" => "center");
    $aField[] = array("head" => _("Field3"), "name" => "FieldName3", "width" => "10%", "align" => "center");
    $aField[] = array("head" => _("Field4"), "name" => "FieldName4", "width" => "10%", "align" => "center");
    $aField[] = array("head" => _("Field5"), "name" => "FieldName5", "width" => "10%", "align" => "center");
    $aField[] = array("head" => _("Field6"), "name" => "FieldName6", "width" => "10%", "align" => "center");
    $aField[] = array("head" => _("Field7"), "name" => "FieldName7", "width" => "10%", "align" => "center");
    $aField[] = array("head" => _("Field8"), "name" => "FieldName8", "width" => "10%", "align" => "center");
    $aField[] = array("head" => _("Field9"), "name" => "FieldName9", "width" => "10%", "align" => "center");
    $aField[] = array("head" => _("Field10"), "name" => "FieldName10", "width" => "10%", "align" => "center");
    $aField[] = array("head" => _("Field11"), "name" => "FieldName11", "width" => "10%", "align" => "center");
    $aField[] = array("head" => _("Field12"), "name" => "FieldName12", "width" => "10%", "align" => "center");
    $aField[] = array("head" => _("功能"), "name" => "btn", "align" => "right");

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
        $aData[$skData]["FieldName7"]         = trim($svData["FieldName7"]);
        $aData[$skData]["FieldName8"]         = trim($svData["FieldName8"]);
        $aData[$skData]["FieldName9"]         = trim($svData["FieldName9"]);
        $aData[$skData]["FieldName10"]         = trim($svData["FieldName10"]);
        $aData[$skData]["FieldName11"]         = trim($svData["FieldName11"]);
        $aData[$skData]["FieldName12"]         = trim($svData["FieldName12"]);

        $aBtn   = array();
        $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "e01110_view", "param" => array("view", trim($svData["FieldID"]))));
        $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "e01110_view", "param" => array("edit", trim($svData["FieldID"]))));
        $aData[$skData]["btn"] = implode("", $aBtn);
    }

    // ----- 資料顯示 & 設定 Grid 上方之功能紐 -----
    $aSet = array(
        "field" => $aField,
        "data"  => $aData,
        // remove:刪除, select:選取, stop:停復用
        "btn"   => array("remove", "select", "stop", "excel", "pdf", "print"),
        // 自定義按鈕
        "cusbtn"   => array(
            array("text" => "按鈕功能", "action" => "Function"),
        ),

    );

    $sHtml .= $eZui->setGridMUL($aSet);

    // ----- 備註 -----
    $aBody = array();
    // &nbsp:空白字元
    $noteContent = _("備註:<br>
                    &nbsp&nbsp 1.備註事項一<br>
                    &nbsp&nbsp 2.備註事項二<br>
                    &nbsp&nbsp 3.備註事項三<br>"
                    );
    $aBody[] = array("flex" => "12", "body" => $eZui->setAlert(array("text" => $noteContent, "style" => "y")));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));
    // ----- 備註 end -----

    echo $sHtml;
	@endphp
    {!! $eZui->setValidata('index') !!}
    </form>
@endsection
