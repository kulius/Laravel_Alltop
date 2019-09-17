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
        $body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm06110')));
        break;
    default:
        $body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm06110')));
        break;
}

$html .= $eZui->setGroup(array('body' => $body));

$body   = array();
$body[] = array('flex' => 12, 'body' => $eZui->setTextBox(array('head' => _('部門編號'), 'name' => '', 'value' => '', 'req' => true)));
$body[] = array('flex' => 12, 'body' => $eZui->setTextBox(array('head' => _('部門名稱'), 'name' => '', 'value' => '', 'req' => true)));
$body[] = array('flex' => 12, 'body' => $eZui->setDateBox(array('head' => _('啟用日期（起始）'), 'name' => 'start', 'value' => '', 'req' => true)));
$body[] = array('flex' => 12, 'body' => $eZui->setDateBox(array('head' => _('啟用日期（結束）'), 'name' => 'end', 'value' => '', 'footer' => $eZui->setFont(array('text' => '※未設定結束日期，則表示永久！', 'style' => 'b')))));
$body[] = array('flex' => 12, 'body' => $eZui->setTextArea(array('head' => _('成立目的'), 'name' => '', 'value' => '', 'req' => true)));

$html .= $eZui->setGroup(array('body' => $body));

/*
$field   = array();
$field[] = array('head' => _('職稱'), 'name' => 'a', 'width' => '15%');
$field[] = array('head' => _('備註'), 'name' => 'b', 'width' => '30%');

$efield   = array();
$efield[] = array('head' => _('職稱'), 'name' => 'a');
$efield[] = array('head' => _('備註'), 'name' => 'b');

$data = array();

foreach ($dataMain as $key => $value) {
$a = trim($value['a']);
$b = trim($value['b']);

//顯示
$data[$key]['a'] = $a;
$data[$key]['b'] = $b;
}

$set = array(
'field'  => $field,
'efield' => $efield,
'data'   => $data,
'btn'    => array('add', 'edit', 'remove'),
);

$html .= $eZui->setEGrid($set);
 */
?>
{!! $html !!}
{!! $eZui->setValidata('main') !!}
<form>
@endsection
