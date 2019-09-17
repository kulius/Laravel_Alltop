@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aOption1 = array();
    $aOption1[] = array("value"=>"0","text"=>_("系統參數"));
    $aOption1[] = array("value"=>"1","text"=>_("系統模組"));
    $aOption1[] = array("value"=>"2","text"=>_("郵件參數"));

    $aOption2 = array();
    $aOption2[] = array("value"=>"0","text"=>_("已鎖定"));
    $aOption2[] = array("value"=>"1","text"=>_("已解鎖"));



$aBody   = array();
$aBody[] = array("flex" => "4", "body" => $eZui->setComboBox(array("head" => _("類別"), "name" => "param_class_srh", "value" => old("param_class_srh"), "option" => $aOption1, "select" => false, "def" => _("請選擇"), "attr" => array("onchange='form.submit()'"))));
$aBody[] = array("flex" => "4", "body" => $eZui->setTextBox(array("head" => _("參數代碼/名稱"), "name" => "ClassType_srh", "value" => old("ClassType_srh"), "option" => '', "select" => false, "def" => _("請選擇"), "attr" => array("onchange='form.submit()'"))));
$aBody[] = array("flex" => "4", "body" => $eZui->setComboBox(array("head" => _("參數狀態"), "name" => "College_srh", "value" => old("College_srh"), "option" => $aOption2, "select" => false, "def" => _("請選擇"), "attr" => array("onchange='form.submit()'"))));
$sHtml .= $eZui->setGroup(array('body' => $aBody));

$aBody   = array();
$aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'search')));
$sHtml .= $eZui->setGroup(array('body' => $aBody));

$aField   = array();
$aField[] = array("head" => _("類別"), "name" => "aa", "width" => "15%");
$aField[] = array("head" => _("參數代碼"), "name" => "bb", "width" => "20%");
$aField[] = array("head" => _("參數名稱"), "name" => "cc", "width" => "20%");
$aField[] = array("head" => _("參數內容"), "name" => "dd", "width" => "20%");
$aField[] = array("head" => _("參數狀態"), "name" => "ee", "width" => "20%");
$aField[] = array("head" => _("所屬功能"), "name" => "ff", "width" => "20%");

// $aEField = array();

// $aEField[] = array("head" => _("類別"), "name" => "aa", "type" => "combo", "option" => array());
// $aEField[] = array("head" => _("參數代碼"), "name" => "bb", "type" => "combo", "option" => array());
// $aEField[] = array("head" => _("參數名稱"), "name" => "cc", "type" => "combo", "option" => array());
// $aEField[] = array("head" => _("參數內容"), "name" => "dd", "type" => "combo", "option" => array());

// $aEField[] = array("head" => _("參數狀態"), "name" => "ee");
// $aEField[] = array("head" => _("所屬功能"), "name" => "ff");


    $aData = array();

// dd($data);
    foreach ($data as $skData => $svData) {
        $saa           = trim($svData["aa"]);
        $sbb           = trim($svData["bb"]);
        $scc           = trim($svData["cc"]);
        $sdd           = trim($svData["dd"]);
        $see           = trim($svData["ee"]);
        $sff           = trim($svData["ff"]);

        //顯示
        $aData[$skData]["aa"]           = $saa;
        $aData[$skData]["bb"]            = $sbb;
        $aData[$skData]["cc"]           = $scc;
        $aData[$skData]["dd"]           = $sdd;
        $aData[$skData]["ee"]           = $see;
        $aData[$skData]["ff"]           = $sff;
}

    $aSet = array(
    'field' => $aField,
    'data' => $aData,
    // "btn" => array(),
    );

    $sHtml .= $eZui->setGridMUL($aSet);

    $aParams = array(
    'aTabInfo' => array(
    'm05110' => array('param' => "", 'title'=>'權限參數維護', 'view' => $sHtml, 'current' => 'active'),
    'm05110_tab2' => array('param' => "", 'title'=>'參數異動維護', 'show' => 'true'),
    )
    );
    $sHTML = $eZui->setTab($aParams);

    //echo $sHtml;
    @endphp
        {!! $sHTML !!}
        {!! $eZui->setValidata('main') !!}
</form>
@endsection
