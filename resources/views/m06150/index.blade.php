@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id="main" method='POST'>
{{ csrf_field() }}
<?php
$html = null;

$body   = array();
$body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'm06150_view', 'param' => array('add'))));

$html .= $eZui->setGroup(array('body' => $body));

$field   = array();
$field[] = array('head' => _('申請人員'), 'name' => 'a', 'width' => '15%');
$field[] = array('head' => _('代理人員'), 'name' => 'b', 'width' => '25%');
$field[] = array('head' => _('代理日期'), 'name' => 'cd', 'width' => '25%');
$field[] = array('head' => _('備註'), 'name' => 'e', 'width' => '30%');
$field[] = array('head' => _('功能'), 'name' => 'btn', 'align' => 'right');

$data = array();

foreach ($dataMain as $key => $value) {
    $a = trim($value['a']);
    $b = trim($value['b']);
    $c = trim($value['c']);
    $d = trim($value['d']);
    $e = trim($value['e']);

    $btn   = array();
    $btn[] = $eZui->setBtnHref(array('ex' => 'view', 'small' => true, 'route' => 'm06150_view', 'param' => array('view', $a)));
    $btn[] = $eZui->setBtnHref(array('ex' => 'edit', 'small' => true, 'route' => 'm06150_view', 'param' => array('edit', $a)));

    //顯示
    $data[$key]['a']   = $a;
    $data[$key]['b']   = $b;
    $data[$key]['cd']  = '起始：' . $c . '<BR>結束：' . $d;
    $data[$key]['e']   = $e;
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
