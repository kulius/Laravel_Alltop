@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody = array();
    $aBody[] = array("flex" => 'auto', "body" => $eZui->setBtnHref(array('ex' => 'add', 'value' => 'add', 'route' => 'b13150_view', 'param' => array('add'))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));


    // ----- Grid 要顯示的欄位 -----
    $aField   = array();
    $aField[] = array("head" => _("租借理由代號"), "name" => "Result", "width" => "30%", "align" => "center");
    $aField[] = array("head" => _("租借理由"), "name" => "Result", "width" => "70%", "align" => "center");
    $aField[] = array("head" => _("功能"), "name" => "btn", "align" => "right");

    // 擷取要輸出到 Grid 的 Model 資料
    $aData = array();
    foreach ($data as $skData => $svData) {
        //隱藏（KEY）
        //$aData[$skData]["FieldID"] = trim($svData["FieldID"]);

        //顯示
        $aData[$skData]["Result"]         = trim($svData["Result"]);


        $aBtn   = array();
        // $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "route_name", "param" => array("view"))));
        $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "route_name", "param" => array("edit")));
        $aData[$skData]["btn"] = implode("", $aBtn);
    }

    // ----- 資料顯示 & 設定 Grid 上方之功能紐 -----
    $aSet = array(
        "field" => $aField,
        "data"  => $aData,
        // remove:刪除, select:選取, stop:停復用
        "btn"   => array("remove"),
    );
    // $sHtml .= $eZui->setGrid($aSet);
    $sHtml .= $eZui->setGridMUL($aSet);

    @endphp
        {!! $sHtml !!}
        {!! $eZui->setValidata('main') !!}
</form>
@endsection
