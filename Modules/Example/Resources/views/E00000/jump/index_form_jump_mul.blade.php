@inject('eZui', 'App\Alltop\BaseView')
@extends('layouts.frame_modal')

@section('content')
<form action="" id="index" method="POST">
    {{ csrf_field() }}
@php
$sHtml = null;

$aForm = array();


$aField   = array();
$aField[] = array("head" => _("資料"), "name" => "data", "width" => "20%");
$aField[] = array("head" => _("資料內容"), "name" => "centent");

$aData = array();
$aModel = array();

$aModel[] = array('seq' => 1, 'data' => 'testing', 'content' => 'content');
$aModel[] = array('seq' => 1, 'data' => 'testing', 'content' => 'content');
$aModel[] = array('seq' => 1, 'data' => 'testing', 'content' => 'content');

foreach ($aModel as $skData => $svData) {
    $sSeq      = trim($svData["seq"]);
    $sData     = trim($svData["data"]);
    $sCcontent = trim($svData["content"]);

    //隱藏（KEY）
    $aData[$skData]["seq"] = $sSeq;

    //顯示
    $aData[$skData]["data"]    = $sData;
    $aData[$skData]["centent"] = $sCcontent;
}

$aSet = array(
    "id" => 'jump',
    "field" => $aField,
    "data"  => $aData,
    "btn"   => array("select"),
);

$sHtml .= $eZui->setGridMUL($aSet);

echo $sHtml;
//dd($sHtml);
@endphp
</form>
{!! $eZui->setValidata('index') !!}
@endsection