@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form method='POST'>
{{ csrf_field() }}
<?php
$html = null;

// $body   = array();
// $body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'cmd' => 'add', 'route' => 's01200_view', 'param' => array('add'))));

// $html .= $eZui->setGroup(array('body' => $body));

$field   = array();
$field[] = array('head' => _i('停復用'), 'name' => 'board_class_status', 'width' => '10%');
$field[] = array('head' => _i('類別名稱'), 'name' => 'board_class_name');

$option   = array();
$option[] = array('value' => '1', 'text' => '啟用');
$option[] = array('value' => '0', 'text' => '停用');

$efield   = array();
$efield[] = array('head' => _i('停復用'), 'name' => 'board_class_status', 'type' => 'radio', 'option' => $option);
$efield[] = array('head' => _i('類別名稱'), 'name' => 'board_class_name');

$data = array();

foreach ($data_main as $_key => $_value) {
    $seq                     = trim($_value['seq']);
    $board_class_name        = trim($_value['board_class_name']);
    $board_class_status      = trim($_value['board_class_status']);
    $board_class_status_text = ($board_class_status ? $eZui->setFont(array("text" => _i("啟用"), "style" => "g")) : $eZui->setFont(array("text" => _i("停用"), "style" => "r")));

    $data[$_key]['seq']                = $seq;
    $data[$_key]['board_class_name']   = $board_class_name;
    $data[$_key]['board_class_status'] = $board_class_status;
}

$set = array(
    'field'  => $field,
    'efield' => $efield,
    'data'   => $data,
    'btn'    => array('save', 'add', 'edit'),
);

$html .= $eZui->setEGrid($set);
?>
{!! $html !!}
{!! $eZui->setValidata('main') !!}
<form>
@endsection
