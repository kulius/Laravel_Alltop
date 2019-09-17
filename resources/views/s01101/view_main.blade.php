@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST'>
{{ csrf_field() }}
<?php
$html = null;

$body = array();

switch ($status) {
    case 'add':
    case 'edit':
        $body[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
        $body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 's01101')));
        break;
    default:
        $body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 's01101')));
        break;
}

$html .= $eZui->setGroup(array('body' => $body));

$body   = array();
$body[] = array('flex' => 12, 'body' => $eZui->setComboBox(array('head' => _i('所屬模組（資料來源：系統參數管理）'), 'name' => 'menu_module', 'value' => $data['menu_module'], 'option' => $data_menu_module, 'def' => _i('請選擇'), 'req' => true)));
$body[] = array('flex' => 12, 'body' => $eZui->setTextBox(array('head' => _i('選單代號（ex：s01）'), 'name' => 'menu_number', 'value' => $data['menu_number'], 'req' => true, 'min' => '3', 'max' => '3')));
$body[] = array('flex' => 12, 'body' => $eZui->setTextBox(array('head' => _i('選單名稱'), 'name' => 'menu_name', 'value' => $data['menu_name'], 'req' => true)));
$body[] = array('flex' => 12, 'body' => $eZui->setNumberBox(array('head' => _i('選單排序（預設：50）'), 'name' => 'menu_sort', 'value' => $data['menu_sort'])));

$option   = array();
$option[] = array('value' => '0', 'text' => _i('啟用'));
$option[] = array('value' => '1', 'text' => _i('停用'));

$body[] = array('flex' => 12, 'body' => $eZui->setRadioBox(array('head' => _i('功能狀態'), 'name' => 'menu_hide', 'value' => $data['menu_hide'], 'option' => $option, 'req' => true)));

$html .= $eZui->setGroup(array('body' => $body));
?>
{!! $html !!}
{!! $eZui->setValidata('main') !!}
<form>
@endsection
