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
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnHref(array("ex" => "leave", 'route' => 'c03120', 'param' => array($sGetParam))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

	$aBody   = array();
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('學習策略'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇', 'attr' => array("onchange=form.submit()"))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

	$aBody   = array();
	$aBody[] = array("flex" => "auto", "body" => $eZui->setJump(array('ex' => 'add', 'text' => '新增選項', "url" => "c03120_add_jump", "param" => array("head" => "新增選項", 'urlParam' => 'rpt'))) );
   	$sHtml .= $eZui->setGroup(array('body' => $aBody));

    // ----- Grid 要顯示的欄位 -----
    $aField   = array();
    $aField[] = array("head" => _("功能"), "name" => "btn", "align" => "right");
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

        $aBtn   = array();
        $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "c03120_edit_edit", "param" => array("edit", trim($svData["FieldID"]))));
        $aData[$skData]["btn"] = implode("", $aBtn);
    }

    $aData[0]["FieldName1"] = 'test';
    $aData[0]["FieldName2"] = 'test';
    $aBtn   = array();
    $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "c03120_edit_edit", "param" => array("edit", '')));
    $aData[0]["btn"] = implode("", $aBtn);

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
