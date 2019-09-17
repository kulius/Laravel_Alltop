@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master_simple')

@section('content')
<form method='POST'>
{{ csrf_field() }}
<?php
$html = null;

$body   = array();
$body[] = array('body' => $eZui->setComboBox(array('head' => _i('範本類別'), 'name' => 'board_class_seq', 'value' => request()->input('board_class_seq'), 'option' => $data_board_class, 'def' => '全部', 'select' => false, 'attr' => array('onclick=submit();'))));

$html .= $eZui->setGroup(array('body' => $body));

$field   = array();
$field[] = array('head' => _i('範本類別'), 'name' => 'board_class_name', 'width' => '20%');
$field[] = array('head' => _i('範本名稱'), 'name' => 'board_template_name');

$data = array();

foreach ($data_main as $_key => $_value) {
    $seq                 = trim($_value['seq']);
    $board_class_name    = trim($_value['board_class_name']);
    $board_template_name = trim($_value['board_template_name']);

    $data[$_key]['seq']                 = $seq;
    $data[$_key]['board_class_name']    = $board_class_name;
    $data[$_key]['board_template_name'] = $board_template_name;
}

$set = array(
    'field' => $field,
    'data'  => $data,
    'btn'   => array('select'),
);

$html .= $eZui->setGridSGL($set);
?>
{!! $html !!}
{!! $eZui->setValidata('main') !!}
<form>
@endsection
