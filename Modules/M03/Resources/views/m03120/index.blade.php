@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form method='POST'>
{{ csrf_field() }}
<?php
$html = null;

$body   = array();
$body[] = array('body' => $eZui->setTextBox(array('head' => _i('公告代號'), 'name' => 'board_number', 'value' => request()->input('board_number'))));

$html .= $eZui->setGroup(array('body' => $body));

$body   = array();
$body[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'search')));
$body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'cmd' => 'add', 'route' => 'm03120_view', 'param' => array('add'))));

$html .= $eZui->setGroup(array('body' => $body));

$field   = array();
$field[] = array('head' => _i('公告狀態'), 'name' => 'board_status', 'width' => '8%');
$field[] = array('head' => _i('公告類型'), 'name' => 'board_type', 'width' => '10%');
$field[] = array('head' => _i('公告代號'), 'name' => 'board_number', 'width' => '10%');
$field[] = array('head' => _i('公告主旨'), 'name' => 'board_title');
$field[] = array('head' => _i('開始日期'), 'name' => 'board_start_date', 'width' => '10%');
$field[] = array('head' => _i('結束日期'), 'name' => 'board_end_date', 'width' => '10%');
$field[] = array('head' => _i('功能'), 'name' => 'btn', 'width' => '15%');

$data = array();

foreach ($data_main as $_key => $_value) {
    $board_status          = null;
    $board_type            = trim($_value['board_type']);
    $board_type_text       = null;
    $board_number          = trim($_value['board_number']);
    $board_title           = trim($_value['board_title']);
    $board_start_date      = trim($_value['board_start_date']);
    $board_start_date_text = ($board_start_date ? date('Y-m-d', strtotime($board_start_date)) : $board_start_date);
    $board_end_date        = trim($_value['board_end_date']);
    $board_end_date_text   = ($board_end_date ? date('Y-m-d', strtotime($board_end_date)) : $board_end_date);

    switch ($board_type) {
        case 'a':
            $board_type_text = '公佈欄';
            break;
        case 'b':
            $board_type_text = '公告';
            break;
        case 'c':
            $board_type_text = 'MAIL';
            break;
        case 'd':
            $board_type_text = '公告及MAIL';
            break;
    }

    if (date('Y-m-d') < $board_start_date) {
        $board_status = $eZui->setFont(array('text' => '暫存', 'style' => 'b'));
    } else if (date('Y-m-d') > $board_end_date) {
        $board_status = $eZui->setFont(array('text' => '下架', 'style' => 'r'));
    } else {
        $board_status = $eZui->setFont(array('text' => '已公布', 'style' => 'g'));
    }

    $btn   = array();
    $btn[] = $eZui->setBtnHref(array('ex' => 'view', 'small' => true, 'cmd' => 'view', 'route' => 'm03120_view', 'param' => array('view', $board_number)));
    $btn[] = $eZui->setBtnHref(array('ex' => 'edit', 'small' => true, 'cmd' => 'edit', 'route' => 'm03120_view', 'param' => array('edit', $board_number)));

    $data[$_key]['board_status']     = $board_status;
    $data[$_key]['board_type']       = $board_type_text;
    $data[$_key]['board_number']     = $board_number;
    $data[$_key]['board_title']      = $board_title;
    $data[$_key]['board_start_date'] = $board_start_date_text;
    $data[$_key]['board_end_date']   = $board_end_date_text;
    $data[$_key]['btn']              = implode('', $btn);
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
