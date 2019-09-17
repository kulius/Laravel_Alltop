@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHtml = null;



    $aField = array();
    $aField[] = array('head' => __('最近登入時間'), 'name' => 'LastSignTime', 'width' => '10%');
    $aField[] = array('head' => __('登入IP'), 'name' => 'SignInIP', 'width' => '20%');
    $aData = array();
    foreach ($data as $skData => $svData) {
        $saaID      =trim($svData['aaID']);
        $sLastSignTime      = trim($svData["LastSignTime"]);
        $sSignInIP      = trim($svData["SignInIP"]);

        //隱藏（KEY）
        $aData[$skData]["aaID"] = $saaID;

        //顯示
        $aData[$skData]["LastSignTime"]         = $sLastSignTime;
        $aData[$skData]["SignInIP"]         = $sSignInIP;

       // $aData[$skData]["btn"]              = implode("", $aBtn);
    }

    $aSet = array(
    'field' => $aField,
    'data' => $aData,
    );

    $sHtml .= $eZui->setGrid($aSet);

    $aMemo   = array();
    $aMemo[] = $eZui->setFont(array("text" => _("備註："), "style" => "r"));
    $aMemo[] = _("1. 此功能應顯示的是使用真實來源IP");
    $sHtml .= $eZui->setAlert(array("text" => $aMemo, "style" => "y"));



    //echo $sHtml;
    @endphp
        {!! $sHtml !!}
        {!! $eZui->setValidata('main') !!}
</form>
@endsection
