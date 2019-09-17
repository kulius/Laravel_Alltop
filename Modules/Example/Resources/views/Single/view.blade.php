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
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'e00100')));
            break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'e00100')));
            break;
    }

    $sHTML .= $eZui->setGroup(array('body' => $aBody));

	$aBody   = array();
    $aBody[] = array('body' => $eZui->setTextBox(array('head' => _('文字方塊'), 'name' => 'text', 'value' => $data['text'])));
    $aBody[] = array('body' => $eZui->setNumberBox(array('head' => _('數字方塊'), 'name' => 'number', 'value' => $data['number'], 'req' => true, 'min' => '3', 'max' => '10')));
    $aBody[] = array('body' => $eZui->setMailBox(array('head' => _('郵件方塊'), 'name' => 'mail', 'value' => $data['mail'], 'req' => true)));
    $aBody[] = array('body' => $eZui->setDateBox(array('head' => _('日期/時間方塊'), 'name' => 'datetime', 'value' => $data['datetime'], 'req' => true)));
    $aBody[] = array('flex' => '12', 'body' => $eZui->setTextArea(array('head' => '文字區塊', 'name' => 'textarea', 'value' => $data['textarea'], 'req' => true)));

    $aOption   = array();
    $aOption[] = array('value' => '1', 'text' => _('選項1'));
    $aOption[] = array('value' => '2', 'text' => _('選項2'));
    $aOption[] = array('value' => '3', 'text' => _('選項3'));
    $aOption[] = array('value' => '4', 'text' => _('選項4'));

    $aBody[] = array('body' => $eZui->setRadioBox(array('head' => _('單選方塊'), 'name' => 'radio', 'value' => $data['radio'], 'option' => $aOption, 'req' => true)));
    $aBody[] = array('body' => $eZui->setCheckBox(array('head' => _('多選方塊'), 'name' => 'check', 'value' => $data['check'], 'option' => $aOption, 'req' => true, 'min' => '3')));
    $aBody[] = array('body' => $eZui->setComboBox(array('head' => _('下拉選單'), 'name' => 'drop', 'value' => $data['drop'], 'option' => $aOption, 'req' => true, 'def' => '請選擇')));
    $aBody[] = array('body' => $eZui->setJumpSel(array('head' => _('彈跳視窗'), 'name' => 'jump', 'value' => $data['jump'], 'option' => $aOption, 'url' => 'e01000_jump', 'param' => array('head' => '資料選擇'), 'req' => true)));

    $sHTML .= $eZui->setGroup(array('body' => $aBody));
	@endphp
    {!! $sHTML !!}
    {!! $eZui->setValidata('main') !!}
    </form>
@endsection
