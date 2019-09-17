@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id="main" method='POST'>
{{ csrf_field() }}
<?php
$html = null;

$option   = array();
$option[] = array('value' => '1', 'text' => '場地租借單');
$option[] = array('value' => '2', 'text' => '請假單');

$body   = array();
$body[] = array('flex' => 12, 'body' => $eZui->setComboBox(array('head' => _('表單類別'), 'name' => '', 'value' => '', 'def' => '全部', 'option' => $option)));

$html .= $eZui->setGroup(array('body' => $body));

$body   = array();
$body[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'search')));

$html .= $eZui->setGroup(array('body' => $body));

$field   = array();
$field[] = array('head' => _('表單類別'), 'name' => 'a', 'width' => '15%');
$field[] = array('head' => _('表單單號'), 'name' => 'b', 'width' => '15%');
$field[] = array('head' => _('表單主旨'), 'name' => 'c');
$field[] = array('head' => _('申請人員'), 'name' => 'd', 'width' => '15%');
$field[] = array('head' => _('申請日期'), 'name' => 'e', 'width' => '10%');
$field[] = array('head' => _('功能'), 'name' => 'btn', 'align' => 'right', 'width' => '10%');

$data = array();

foreach ($dataMain as $key => $value) {
    $a = trim($value['a']);
    $b = trim($value['b']);
    $c = trim($value['c']);
    $d = trim($value['d']);
    $e = trim($value['e']);

    $btn   = array();
    $btn[] = $eZui->setBtnHref(array('ex' => 'view', 'small' => true, 'route' => 'm06160_view', 'param' => array('view', $b)));

    //顯示
    $data[$key]['a']   = $a;
    $data[$key]['b']   = $b;
    $data[$key]['c']   = $c;
    $data[$key]['d']   = $d;
    $data[$key]['e']   = $e;
    $data[$key]['btn'] = implode('', $btn);
}

$set = array(
    'field' => $field,
    'data'  => $data,
);

$html .= $eZui->setGrid($set);
?>
{!! $html !!}
{!! $eZui->setValidata('main') !!}
<form>
@endsection
