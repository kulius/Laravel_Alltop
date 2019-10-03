@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody   = array();

    $aOption   = array();
    $aOption[] = array("value" => "1", "text" => _("-"));
    $aOption[] = array("value" => "2", "text" => _("行政大樓"));
    $aOption[] = array("value" => "3", "text" => _("科學館"));
    $aOption[] = array("value" => "4", "text" => _("明德樓"));
    $aOption[] = array("value" => "5", "text" => _("芳蘭樓"));
    $aOption[] = array("value" => "6", "text" => _("創意館"));
    $aOption[] = array("value" => "7", "text" => _("視聽館"));
    $aOption[] = array("value" => "8", "text" => _("至善樓"));
    $aOption[] = array("value" => "9", "text" => _("圖書館"));
    $aOption[] = array("value" => "10", "text" => _("體育館"));
    $aOption[] = array("value" => "11", "text" => _("藝術館"));
    $aOption[] = array("value" => "12", "text" => _("篤行樓"));

	$aBody = array();
	$aBody[] = array("flex" => '2', "body" => $eZui->setComboBox(array("head" => __("所屬大樓"), "name" => "Building", "value" => '', "option" => $aOption, "def" => _("請選擇"))));
	$aBody[] = array("flex" => '2', "body" => $eZui->setComboBox(array("head" => __("所在樓層"), "name" => "Semester_srh", "value" => old("Semester_srh"), "option" => $aOption,"def" => _("請選擇"))));
	$aBody[] = array("flex" => '2', "body" => $eZui->setComboBox(array("head" => __("場地類型"), "name" => "DayfgID_srh", "value" => old("DayfgID_srh"), "option" => $aOption,"def" => _("請選擇"))));
	$aBody[] = array("flex" => '2', "body" => $eZui->setComboBox(array("head" => __("場地名稱"), "name" => "ClassTypeID_srh", "value" => old("ClassTypeID_srh"),"option" => $aOption,  "def" => _("請選擇"))));
	$aBody[] = array("flex" => '2', "body" => $eZui->setComboBox(array("head" => __("管理單位"), "name" => "College_srh", "value" => old("College_srh"), "option" => $aOption, "def" => _("請選擇"))));

	$sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody = array();
    $aBody[] = array("flex" => 'auto', "body" => $eZui->setBtnHref(array('ex' => 'add', 'value' => 'add', 'route' => 'b13110_view', 'param' => array('add'))));
    $aBody[] = array("flex" => 'auto', "body" => $eZui->setBtnSubmit(array('ex' => 'search', 'value' => 'search')));
    $aBody[] = array("flex" => 'auto', "body" => $eZui->setBtnSubmit(array('ex' => 'excel', 'value' => 'excel')));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aField   = array();
    $aField[] = array("head" => _("場地編號"), "name" => "Result", "width" => "10%", "align" => "left");
    $aField[] = array("head" => _("場地名稱"), "name" => "Result", "width" => "10%", "align" => "left");
    $aField[] = array("head" => _("場地類型"), "name" => "Result", "width" => "10%", "align" => "left");
    $aField[] = array("head" => _("所屬大樓"), "name" => "Result", "width" => "10%", "align" => "left");
    $aField[] = array("head" => _("所在樓層"), "name" => "Result", "width" => "10%", "align" => "left");
    $aField[] = array("head" => _("管理單位"), "name" => "Result", "width" => "10%", "align" => "left");
    $aField[] = array("head" => _("功能"), "name" => "btn", "width" => "10%", "align" => "left");

    // 擷取要輸出到 Grid 的 Model 資料
    $aData = array();
    foreach ($data as $skData => $svData) {
        // $aData[$skData]["Year"]         = trim($svData["Year"]);
        // $aData[$skData]["Number"]         = trim($svData["Number"]);
        // $aData[$skData]["Comment"]         = trim($svData["Comment"]);
        // $aData[$skData]["Coin"]         = trim($svData["Coin"]);
        $aData[$skData]["Result"]         = trim($svData["Result"]);
        $aBtn   = array();
        $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "b13110_view", "param" => array("view")));
        $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "b13110_view", "param" => array("edit")));

        $aData[$skData]["btn"]            = implode("", $aBtn);
    }

    // // ----- 資料顯示 & 設定 Grid 上方之功能紐 -----
    $aSet = array(
        "id"=>"b13110",
        "field" => $aField,
        "data"  => $aData,
        // remove:刪除, select:選取, stop:停復用
        "btn"   => array("remove"),
    );
    // $sHtml .= $eZui->setGrid($aSet);
    $sHtml .= $eZui->setGridMUL($aSet);
    $aParams = array(
    'aTabInfo' => array(
    'b13110' => array('param' => "", 'title'=>'保管組', 'view' => $sHtml, 'current' => 'active'),
    'b13110_tab1' => array('param' => "", 'title'=>'事務組'),
    'b13110_tab2' => array('param' => "", 'title'=>'場地管理單位'),
    )
    );
    $sHtml = $eZui->setTab($aParams);
    //echo $sHtml;
    @endphp
        {!! $sHtml !!}
        {!! $eZui->setValidata('main') !!}
</form>
@endsection
