@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form method='POST'>
{{ csrf_field() }}
<?php
$html = null;

$body = array();

$html .= $eZui->setGroup(array('body' => $body));

$body   = array();
$body[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'search')));
$body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'cmd' => 'add', 'route' => 's01200_view', 'param' => array('add'))));

$html .= $eZui->setGroup(array('body' => $body));

$field   = array();
$field[] = array('head' => _i('帳號'), 'name' => 'user_number', 'width' => '20%');
$field[] = array('head' => _i('姓名'), 'name' => 'user_name', 'width' => '15%');
$field[] = array('head' => _i('授權狀態'), 'name' => 'authorize', 'width' => '10%');
$field[] = array('head' => _i('備註'), 'name' => 'remark', 'width' => '30%');
$field[] = array('head' => _i('功能'), 'name' => 'btn', 'align' => 'right');

$data = array();

foreach ($data_main as $_key => $_value) {
    $user_number    = trim($_value['user_number']);
    $user_name      = trim($_value['user_name']);
    $authorize      = trim($_value['authorize']);
    $authorize_text = ($authorize ? $eZui->setFont(array("text" => _i("授權"), "style" => "g")) : $eZui->setFont(array("text" => _i("停權"), "style" => "r")));
    $remark         = trim($_value['remark']);

    $btn   = array();
    $btn[] = $eZui->setBtnHref(array('ex' => 'view', 'small' => true, 'cmd' => 'view', 'route' => 's01200_view', 'param' => array('view', $user_number)));
    $btn[] = $eZui->setBtnHref(array('ex' => 'edit', 'small' => true, 'cmd' => 'edit', 'route' => 's01200_view', 'param' => array('edit', $user_number)));

    $data[$_key]['user_number'] = $user_number;
    $data[$_key]['user_name']   = $user_name;
    $data[$_key]['authorize']   = $authorize_text;
    $data[$_key]['remark']      = $remark;
    $data[$_key]['btn']         = implode('', $btn);
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
