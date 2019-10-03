@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')

@include('layouts.error_tips', array('errors' => $errors))

    <form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
	@php
    $sHtml = null;
   
    switch ($status) {
        case 'edit':
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm04140')));

            break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm04140')));
            break;
    }
    $sHtml .= $eZui->setGroup(array("body" => $aBody));

    $aBody   = array();
    $aBody[] = array("head" => _("題庫名稱"), "flex" => "6", "body" => $eZui->setFont(array("text" => _("1071教師調查"))));
    $sHtml.= $eZui->setGroup(array("body" => $aBody));

    $aBody   = array();
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array('ex' => 'add',"text" => _("新增題目"), "style" => "so")));
    $sHtml.= $eZui->setGroup(array("body" => $aBody));

    $aField   = array();
    $aField[] = array("head" => _("題目編號"), "name" => "aa", "width" => "20%");
    $aField[] = array("head" => _("題目類型"), "name" => "bb", "width" => "20%");
    $aField[] = array("head" => _("題目名稱"), "name" => "cc", "width" => "20%");
    $aField[] = array("head" => _("題目選項"), "name" => "dd", "width" => "20%");

    $aData = array();
    foreach ($data as $skData => $svData) {
        $aData[$skData]["aa"]         = trim($svData["aa"]);
        $aData[$skData]["bb"]         = trim($svData["bb"]);
        $aData[$skData]["cc"]         = trim($svData["cc"]);
        $aData[$skData]["dd"]         = trim($svData["dd"]);
	}

    $aSet = array(
        "field"  => $aField,
        "data"   => $aData,
        "btn"    =>array("remove")
    );

    $sHtml .= $eZui->setGridMUL($aSet);

	@endphp
    {!! $sHtml !!}
    {!! $eZui->setValidata('main') !!}
    </form>
@endsection
