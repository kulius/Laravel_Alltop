@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody   = array();

    $aBody[] = array("flex" => '2', "body" => $eZui->setTextBox(array("head" => __("信用單號"), "name" => "College_srh", "value" => "")));
    $aBody[] = array("flex" => 'auto', "body" => $eZui->setBtnSubmit(array('ex' => 'search', 'value' => 'search')));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aField   = array();
    $aField[] = array("head" => _("借用場地名稱"), "name" => "Result", "width" => "10%", "align" => "left");
    $aField[] = array("head" => _("借用日期"), "name" => "Result", "width" => "10%", "align" => "left");
    $aField[] = array("head" => _("借用時段"), "name" => "Result", "width" => "10%", "align" => "left");
    $aField[] = array("head" => _("審核進度"), "name" => "Result", "width" => "10%", "align" => "left");

    // 擷取要輸出到 Grid 的 Model 資料
    $aData = array();
    foreach ($data as $skData => $svData) {
        // $aData[$skData]["Year"]         = trim($svData["Year"]);
        // $aData[$skData]["Number"]         = trim($svData["Number"]);
        // $aData[$skData]["Comment"]         = trim($svData["Comment"]);
        // $aData[$skData]["Coin"]         = trim($svData["Coin"]);
        $aData[$skData]["Result"]         = trim($svData["Result"]);
        // $aBtn   = array();
        // $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "b13210_tab2_view", "param" => array("view")));
        // $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "b13210_tab2_view", "param" => array("edit")));

        // $aData[$skData]["btn"]            = implode("", $aBtn);
    }

    // // ----- 資料顯示 & 設定 Grid 上方之功能紐 -----
    $aSet = array(
        "id"=>"b13220_tab2",
        "field" => $aField,
        "data"  => $aData,
        // remove:刪除, select:選取, stop:停復用
        "btn"   => array(""),
    );
    // $sHtml .= $eZui->setGrid($aSet);
    $sHtml .= $eZui->setGrid($aSet);

    $aParams = array(
    'aTabInfo' => array(
    'b13220' => array('param' => "", 'title'=>'備用審核'),
    'b13220_tab1' => array('param' => "", 'title'=>'常用審核字彙'),
    'b13220_tab2' => array('param' => "", 'title'=>'借用單號查詢', 'view' => $sHtml, 'current' => 'active'),
    'b13220_tab3' => array('param' => "", 'title'=>'事務組/出納組'),
    'b13220_tab4' => array('param' => "", 'title'=>'批次週期性申請'),
    )
    );
    $sHtml = $eZui->setTab($aParams);
    //echo $sHtml;
    @endphp
        {!! $sHtml !!}
        {!! $eZui->setValidata('main') !!}
</form>
@endsection
