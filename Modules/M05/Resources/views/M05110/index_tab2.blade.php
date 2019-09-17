@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='judge' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aOption1 = array();
    $aOption1[] = array("value"=>"0","text"=>_("系統參數"));
    $aOption1[] = array("value"=>"1","text"=>_("系統模組"));
    $aOption1[] = array("value"=>"2","text"=>_("郵件參數"));


    $aBody   = array();
    $aBody[] = array("body" => $eZui->setComboBox(array("head" => _("類別"), "name" => "Kind_srh", "value" => '', "option" => $aOption1, "select" => false)));
    $aBody[] = array("body" => $eZui->setTBox(array("head" => _("參數代碼/名稱"), "name" => "", "value" => '', "select" => false)));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'search')));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aField   = array();
    $aField[] = array("head" => _("類別"), "name" => "aa", "width" => "6%", "align" => "center");
    $aField[] = array("head" => _("參數代碼"), "name" => "bb", "width" => "6%", "align" => "center");
    $aField[] = array("head" => _("參數名稱"), "name" => "cc", "width" => "15%");
    $aField[] = array("head" => _("參數內容"), "name" => "dd", "width" => "17%");

    $aField[] = array("head" => _("異動人員"), "name" => "gg");
    $aField[] = array("head" => _("異動日期"), "name" => "hh")


    $aData = array();
    foreach ($data as $skData => $svData) {
        $saa           = trim($svData["aa"]);
        $sbb           = trim($svData["bb"]);
        $scc           = trim($svData["cc"]);
        $sdd           = trim($svData["dd"]);
        $sgg           = trim($svData["gg"]);
        $shh           = trim($svData["hh"]);

        //顯示
        $aData[$skData]["aa"]           = $saa;
        $aData[$skData]["bb"]           = $sbb;
        $aData[$skData]["cc"]           = $scc;
        $aData[$skData]["dd"]           = $sdd;
        $aData[$skData]["gg"]           = $sgg;
        $aData[$skData]["hh"]           = $shh;
}}

    $aSet = array(
        'field' => $aField,
        'data' => $aData,
        //"btn" => array(""),
    );

    $sHtml .= $eZui->setGridMUL($aSet);

    $aParams = array(
        'aTabInfo' => array(
            'm05110' => array('param' => "", 'title'=>'參數權限設定'),
            'm05110_tab2' => array('param' => "", 'title'=>'參數異動紀錄', 'view' => $sHtml, 'current' => 'active'),

        )
    );
    $sHTML = $eZui->setTab($aParams);

    //echo $sHtml;
    @endphp
            {!! $sHTML !!}
            {!! $eZui->setValidata('judge') !!}
</form>
@endsection
