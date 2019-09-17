@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST'>
{{ csrf_field() }}
<?php
$html = null;

$body   = array();
$body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 's01201_view', 'param' => array('add'))));

$html .= $eZui->setGroup(array('body' => $body));

$field   = array();
$field[] = array('head' => _i('群組代號'), 'name' => 'group_number', 'width' => '15%');
$field[] = array('head' => _i('群組名稱'), 'name' => 'group_name', 'width' => '30%');
$field[] = array('head' => _i('功能'), 'name' => 'btn', 'align' => 'right');

$data = array();

foreach ($data_main as $_key => $_value) {
    $group_number = trim($_value['group_number']);
    $group_name   = trim($_value['group_name']);

    $btn   = array();
    $btn[] = $eZui->setBtnHref(array('ex' => 'view', 'small' => true, 'route' => 's01201_view', 'param' => array('view', $group_number)));
    $btn[] = $eZui->setBtnHref(array('ex' => 'edit', 'small' => true, 'route' => 's01201_view', 'param' => array('edit', $group_number)));

    //顯示
    $data[$_key]['group_number'] = $group_number;
    $data[$_key]['group_name']   = $group_name;
    $data[$_key]['btn']          = implode('', $btn);
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
