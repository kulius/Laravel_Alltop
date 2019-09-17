@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id="main" method='POST'>
{{ csrf_field() }}
<?php
$html = null;

$field   = array();
$field[] = array('head' => _('部門代號'), 'name' => 'a', 'width' => '15%');
$field[] = array('head' => _('部門名稱'), 'name' => 'b', 'width' => '25%');
$field[] = array('head' => _('虛擬部門'), 'name' => 'c', 'width' => '10%');
$field[] = array('head' => _('功能'), 'name' => 'btn', 'align' => 'right');

$data = array();

foreach ($dataMain as $key => $value) {
    $a = trim($value['a']);
    $b = trim($value['b']);
    $c = ($value['c'] ? 'V' : null);

    $btn   = array();
    $btn[] = $eZui->setBtnHref(array('ex' => 'edit', 'small' => true, 'route' => 'm06120_view', 'param' => array($a)));

    //顯示
    $data[$key]['a']   = $a;
    $data[$key]['b']   = $b;
    $data[$key]['c']   = $c;
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
