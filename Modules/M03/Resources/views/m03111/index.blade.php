@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form method='POST'>
{{ csrf_field() }}
<?php
$html = null;

$body   = array();
$body[] = array('body' => $eZui->setComboBox(array('head' => _i('範本類別'), 'name' => 'board_class_seq', 'value' => request()->input('board_class_seq'), 'option' => $data_board_class, 'def' => '全部', 'select' => false)));

$html .= $eZui->setGroup(array('body' => $body));

$body   = array();
$body[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'search')));
$body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'cmd' => 'add', 'route' => 'm03111_view', 'param' => array('add'))));

$html .= $eZui->setGroup(array('body' => $body));

$field   = array();
$field[] = array('head' => _i('停復用'), 'name' => 'board_template_status', 'width' => '10%');
$field[] = array('head' => _i('範本類別'), 'name' => 'board_class_name', 'width' => '20%');
$field[] = array('head' => _i('範本名稱'), 'name' => 'board_template_name');
$field[] = array('head' => _i('功能'), 'name' => 'btn', 'width' => '15%');

$data = array();

foreach ($data_main as $_key => $_value) {
    $seq                        = trim($_value['seq']);
    $board_class_name           = trim($_value['board_class_name']);
    $board_template_name        = trim($_value['board_template_name']);
    $board_template_status      = trim($_value['board_template_status']);
    $board_template_status_text = ($board_template_status ? $eZui->setFont(array("text" => _i("啟用"), "style" => "g")) : $eZui->setFont(array("text" => _i("停用"), "style" => "r")));

    $btn   = array();
    $btn[] = $eZui->setBtnHref(array('ex' => 'view', 'small' => true, 'cmd' => 'view', 'route' => 'm03111_view', 'param' => array('view', $seq)));
    $btn[] = $eZui->setBtnHref(array('ex' => 'edit', 'small' => true, 'cmd' => 'edit', 'route' => 'm03111_view', 'param' => array('edit', $seq)));

    $data[$_key]['seq']                   = $seq;
    $data[$_key]['board_class_name']      = $board_class_name;
    $data[$_key]['board_template_name']   = $board_template_name;
    $data[$_key]['board_template_status'] = $board_template_status_text;
    $data[$_key]['btn']                   = implode('', $btn);
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
