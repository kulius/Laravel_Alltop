@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHtml = null;
    $aBody = array();
    $aBody[] = array("flex" => 'auto', "body" => $eZui->setBtnHref(array('ex' => 'add', 'value' => 'add', 'route' => 'b13220_tab1_view', 'param' => array('add'))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    // ----- Grid 要顯示的欄位 -----
    $aField   = array();
    $aField[] = array("head" => _("代號"), "name" => "Result", "width" => "20%", "align" => "center");
    $aField[] = array("head" => _("常用字彙"), "name" => "Result", "width" => "80%", "align" => "center");
    $aField[] = array("head" => _("功能"), "name" => "btn", "align" => "right");

    // 擷取要輸出到 Grid 的 Model 資料
    $aData = array();
    foreach ($data as $skData => $svData) {

        //顯示
        $aData[$skData]["Result"]         = trim($svData["Result"]);


        $aBtn   = array();
        $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "b13220_tab1_view", "param" => array("edit")));
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

    $aParams = array(
    'aTabInfo' => array(
    'b13220' => array('param' => "", 'title'=>'備用審核'),
    'b13220_tab1' => array('param' => "", 'title'=>'常用審核字彙', 'view' => $sHtml, 'current' => 'active'),
    'b13220_tab2' => array('param' => "", 'title'=>'借用單號查詢'),
    'b13220_tab3' => array('param' => "", 'title'=>'事務組/出納組'),
    'b13220_tab4' => array('param' => "", 'title'=>'批次週期性申請'),
    )
    );
    $sHtml = $eZui->setTab($aParams);
    @endphp
        {!! $sHtml !!}
        {!! $eZui->setValidata('main') !!}
</form>
@endsection
