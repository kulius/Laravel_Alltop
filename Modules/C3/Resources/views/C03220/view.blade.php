@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form method='POST' id='index'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody   = array();
    $sGetParam = null;
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnHref(array("ex" => "leave", 'route' => 'c03220', 'param' => array($sGetParam))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));


    $aBody   = array();
    $aOption = array();
    $aOption[] = array('value' => 0, 'text' => '非常不滿意');
    $aOption[] = array('value' => 1, 'text' => '不滿意');
    $aOption[] = array('value' => 2, 'text' => '普通');
    $aOption[] = array('value' => 3, 'text' => '滿意');
    $aOption[] = array('value' => 4, 'text' => '非常滿意');
    $aBody[] = array("flex" => '12', "body" => $eZui->setRadioBox(array("head" => _("1 . 學習時，我會檢視自己對於書本內容的理解程度。"), "inline" => true, "name" => "state1", "value" => '2', "option" => $aOption)));

    $aOption = array();
    $aOption[] = array('value' => 0, 'text' => '非常不滿意');
    $aOption[] = array('value' => 1, 'text' => '不滿意');
    $aOption[] = array('value' => 2, 'text' => '普通');
    $aOption[] = array('value' => 3, 'text' => '滿意');
    $aOption[] = array('value' => 4, 'text' => '非常滿意');
    $aBody[] = array("flex" => '12', "body" => $eZui->setRadioBox(array("head" => _("2 . 學習時我會問自己一些問題，以了解自己理解或學會的程度。"), "inline" => true, "name" => "state2", "value" => '2', "option" => $aOption)));

    $aOption = array();
    $aOption[] = array('value' => 0, 'text' => '非常不滿意');
    $aOption[] = array('value' => 1, 'text' => '不滿意');
    $aOption[] = array('value' => 2, 'text' => '普通');
    $aOption[] = array('value' => 3, 'text' => '滿意');
    $aOption[] = array('value' => 4, 'text' => '非常滿意');
    $aBody[] = array("flex" => '12', "body" => $eZui->setRadioBox(array("head" => _("3 . 我會回想過去學過的知識，來幫助自己理解或吸收新的知識。"), "inline" => true, "name" => "state3", "value" => '2', "option" => $aOption)));
    $sGroup = $eZui->setGroup(array('body' => $aBody));


    $aBody   = array();
	$aBody[] = array("flex" => "12", "head" => _("問卷名稱"), "body" => $sGroup);
	$sHtml .= $eZui->setCard(array("body" => $aBody));

    $aBody   = array();
    $sGetParam = null;
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnHref(array("ex" => "leave", 'route' => 'c03220', 'param' => array($sGetParam))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    echo $sHtml;
    @endphp
    {!! $eZui->setValidata('index') !!}
    </form>
@endsection
