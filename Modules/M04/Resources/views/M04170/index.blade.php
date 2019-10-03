@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form method='POST' id='index'>
    {{ csrf_field() }}
	@php
    $sHtml = null;

   
    $aField   = array();
    $aField[] = array("head" => _("學年"), "name" => "aa", "width" => "20%");
    $aField[] = array("head" => _("學期"), "name" => "bb", "width" => "20%");
    $aField[] = array("head" => _("問卷名稱"), "name" => "cc", "width" => "20%");
    $aField[] = array("head" => _("填寫狀態"), "name" => "dd", "width" => "20%");

    $aField[] = array("head" => _("功能"), "name" => "btn");

    $aData = array();
    foreach ($data as $skData => $svData) {
        $aData[$skData]["aa"]         = trim($svData["aa"]);
        $aData[$skData]["bb"]         = trim($svData["bb"]);
        $aData[$skData]["cc"]         = trim($svData["cc"]);
        $aData[$skData]["dd"]         = trim($svData["dd"]);

        $aBtn   = array();
        $aBtn[]  = $eZui->setBtnHref(array("ex" => "click", "small" => true, 'route' => 'm04170_view'));
        $aData[$skData]["btn"]    = implode("", $aBtn);
    }

    $aSet = array(
        "field"  => $aField,
        "data"   => $aData,
    );

    $sHtml .= $eZui->setGrid($aSet);

    echo $sHtml;
	@endphp
    {!! $eZui->setValidata('index') !!}
    </form>
@endsection
