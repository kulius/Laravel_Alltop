@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
	@php
    $sHTML = null;

    switch ($status) {
        case 'add':
        case 'edit':
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'a01120')));
            break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'a01120')));
            break;
    }

    $sHTML .= $eZui->setGroup(array('body' => $aBody));

	$aBody   = array();
    $aOption   = array();
    $aOption[] = array("key" => "1", "value" => _("使用中"));
    $aOption[] = array("key" => "0", "value" => _("停用"));

    $aBody[] = array("flex" => 12, "body" => $eZui->setComboBox(array("head" => _("狀態"), "name" => "state", "value" => $data["state"], "option" => $aOption, "req" => true, "select" => false)));

    $aOption   = array();
    $aOption[] = array("key" => "1", "value" => _("日間"));
    $aOption[] = array("key" => "0", "value" => _("夜間"));

    $aBody[] = array("flex" => 12, "body" => $eZui->setComboBox(array("head" => _("日夜別"), "name" => "DayNightLevel", "value" => $data["DayNightLevel"], "option" => $aOption, "req" => true, "select" => false)));

    $aBody[] = array("flex" => 3, "body" => $eZui->setTextBox(array("head" => _("部別代碼"), "name" => "Dayfg", "value" => $data["Dayfg"], "req" => true)));
    $aBody[] = array("flex" => 3, "body" => $eZui->setTextBox(array("head" => _("部別名稱"), "name" => "DayfgName", "value" => $data["DayfgName"], "req" => true)));
    $aBody[] = array("flex" => 3, "body" => $eZui->setTextBox(array("head" => _("部別簡稱"), "name" => "DayfgAlias", "value" => $data["DayfgAlias"])));
    $aBody[] = array("flex" => 3, "body" => $eZui->setTextBox(array("head" => _("部別英文名稱"), "name" => "DayfgENGName", "value" => $data["DayfgENGName"])));
    $aBody[] = array("body" => $eZui->setTextBox(array("head" => _("【課程】部別碼"), "name" => "DayfgCus", "value" => $data["DayfgCus"])));
    $aBody[] = array("body" => $eZui->setTextBox(array("head" => _("畢業證書部別碼"), "name" => "DiplomaDayfgNo", "value" => $data["DiplomaDayfgNo"])));
    $aBody[] = array("body" => $eZui->setTextBox(array("head" => _("順序"), "name" => "Seq]", "value" => $data["Seq"])));

    $sHTML .= $eZui->setGroup(array('body' => $aBody));
	@endphp
    {!! $sHTML !!}
    {!! $eZui->setValidata('main') !!}
    </form>
@endsection
