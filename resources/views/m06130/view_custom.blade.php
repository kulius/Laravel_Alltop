@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id="main" method='POST'>
{{ csrf_field() }}
<?php
$html = null;

$body   = array();
$body[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
$body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm06130')));

$html .= $eZui->setGroup(array('body' => $body));

$body   = array();
$body[] = array('flex' => 12, 'body' => $eZui->setTextBox(array('head' => _('範本代號'), 'name' => '', 'value' => 'default', 'req' => true)));
$body[] = array('flex' => 12, 'body' => $eZui->setTextBox(array('head' => _('範本名稱'), 'name' => '', 'value' => '自訂表單範本', 'req' => true)));
$body[] = array('flex' => 12, 'body' => $eZui->setEditArea(array('head' => _('範本內容'), 'name' => 'ss', 'value' => '', 'req' => true)));

$html .= $eZui->setGroup(array('body' => $body));

/*
$field   = array();
$field[] = array('head' => _('申請身分'), 'name' => 'b', 'width' => '15%');
$field[] = array('head' => _('功能'), 'name' => 'btn', 'align' => 'right');

$data = array();

foreach ($dataGrid as $key => $value) {
$a = trim($value['a']);
$b = trim($value['b']);

$btn   = array();
$btn[] = $eZui->setBtnHref(array('ex' => 'view', 'small' => true, 'route' => 'm06130_view_grid', 'param' => array($dataMain['a'], 'view', $a)));
$btn[] = $eZui->setBtnHref(array('ex' => 'edit', 'small' => true, 'route' => 'm06130_view_grid', 'param' => array($dataMain['a'], 'edit', $a)));

//顯示
$data[$key]['b']   = $b;
$data[$key]['btn'] = implode('', $btn);
}

$set = array(
'field' => $field,
'data'  => $data,
);

$html .= $eZui->setGrid($set);
 */
?>
{!! $html !!}
{!! $eZui->setValidata('main') !!}
<form>
@endsection
