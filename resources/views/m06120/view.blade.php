@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id="main" method='POST'>
{{ csrf_field() }}
<?php
$html = null;

$body   = array();
$body[] = array('flex' => 12, 'body' => $eZui->setTextBox(array('head' => _('部門編號'), 'name' => '', 'value' => $dataMain['a'], 'status' => 'view')));
$body[] = array('flex' => 12, 'body' => $eZui->setTextBox(array('head' => _('部門名稱'), 'name' => '', 'value' => $dataMain['b'], 'status' => 'view')));

$html .= $eZui->setGroup(array('body' => $body));

$body   = array();
$body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'm06120_view2', 'param' => array($dataMain['a'], 'add'))));
$body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm06120')));

$html .= $eZui->setGroup(array('body' => $body));

$field   = array();
$field[] = array('head' => _('簽核代號'), 'name' => 'a', 'width' => '15%');
$field[] = array('head' => _('職務名稱'), 'name' => 'b', 'width' => '20%');
$field[] = array('head' => _('所屬人員'), 'name' => 'c', 'width' => '15%');
$field[] = array('head' => _('身分別'), 'name' => 'd', 'width' => '15%');
$field[] = array('head' => _('功能'), 'name' => 'btn', 'align' => 'right');

$data = array();

foreach ($dataGrid as $key => $value) {
    $a = trim($value['a']);
    $b = trim($value['b']);
    $c = trim($value['c']);
    $d = trim($value['d']);

    $btn   = array();
    $btn[] = $eZui->setBtnHref(array('ex' => 'view', 'small' => true, 'route' => 'm06120_view2', 'param' => array($dataMain['a'], 'view', $a)));
    $btn[] = $eZui->setBtnHref(array('ex' => 'edit', 'small' => true, 'route' => 'm06120_view2', 'param' => array($dataMain['a'], 'edit', $a)));

    //顯示
    $data[$key]['a']   = $a;
    $data[$key]['b']   = $b;
    $data[$key]['c']   = $c;
    $data[$key]['d']   = $d;
    $data[$key]['btn'] = implode('', $btn);
}

$set = array(
    'field' => $field,
    'data'  => $data,
    'btn'   => array('remove'),
);

$html .= $eZui->setGridMUL($set);
?>
{!! $html !!}
{!! $eZui->setValidata('main') !!}
<form>
@endsection
