@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id="main" method='POST'>
{{ csrf_field() }}
<?php
$html = null;

$body = array();

switch ($status) {
    case 'add':
    case 'edit':
        $body[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
        $body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm06120_view', 'param' => array($id))));
        break;
    default:
        $body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm06120_view', 'param' => array($id))));
        break;
}

$html .= $eZui->setGroup(array('body' => $body));

$option   = array();
$option[] = array('value' => '1', 'text' => '組長');
$option[] = array('value' => '2', 'text' => '副組長');
$option[] = array('value' => '3', 'text' => '辦事員');

$body   = array();
$body[] = array('flex' => 12, 'body' => $eZui->setTextBox(array('head' => _('簽核代號'), 'name' => '', 'value' => '系統自動產生', 'status' => 'view')));
$body[] = array('flex' => 12, 'body' => $eZui->setComboBox(array('head' => _('職稱選擇'), 'name' => '', 'value' => '', 'def' => '請選擇', 'option' => $option, 'req' => true)));
$body[] = array('flex' => 12, 'body' => $eZui->setJumpSel(array('head' => _('所屬人員'), 'name' => 'jump', 'value' => '', 'option' => '', 'url' => '', 'param' => array('head' => '資料選擇'), 'req' => true)));

$html .= $eZui->setGroup(array('body' => $body));
?>
{!! $html !!}
{!! $eZui->setValidata('main') !!}
<form>
@endsection