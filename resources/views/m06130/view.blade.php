@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id="main" method='POST'>
{{ csrf_field() }}
<?php
$html = null;

$body   = array();
$body[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
$body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm06130')));

$html .= $eZui->setGroup(array('body' => $body));

$body   = array();
$body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'text' => '新增流程', 'route' => 'm06130_view_grid', 'param' => array('edit', '1', 'add'))));

$grid = $eZui->setGroup(array('body' => $body));

$field   = array();
$field[] = array('head' => _('序'), 'name' => 'a', 'width' => '5%');
$field[] = array('head' => _('關卡資訊'), 'name' => 'b', 'width' => '30%');
$field[] = array('head' => _('關卡條件'), 'name' => 'c', 'width' => '40%');
$field[] = array('head' => _('功能'), 'name' => 'btn', 'align' => 'right');

$data = array();

foreach ($dataGrid as $key => $value) {
    $a = trim($value['a']);
    $b = trim($value['b']);
    $c = trim($value['c']);
    $d = trim($value['d']);

    $btn   = array();
    $btn[] = $eZui->setBtnHref(array('ex' => 'view', 'small' => true, 'route' => 'm06130_view_grid', 'param' => array('edit', '1', 'view', $a)));
    $btn[] = $eZui->setBtnHref(array('ex' => 'edit', 'small' => true, 'route' => 'm06130_view_grid', 'param' => array('edit', '1', 'edit', $a)));

    //顯示
    $data[$key]['a']   = $a;
    $data[$key]['b']   = $b;
    $data[$key]['c']   = $c;
    $data[$key]['d']   = $d;
    $data[$key]['btn'] = implode('', $btn);
}

$set = array(
    'id'    => 'view_1',
    'field' => $field,
    'data'  => $data,
    'btn'   => array('remove'),
);

$grid .= $eZui->setGridMUL($set);

$option   = array();
$option[] = array('value' => '1', 'text' => '學生請假單');
$option[] = array('value' => '2', 'text' => '場地租借單');

$body   = array();
$body[] = array('flex' => 12, 'body' => $eZui->setComboBox(array('head' => _('對應表單'), 'name' => '', 'value' => '1', 'option' => $option, 'req' => true)));
$body[] = array('flex' => 6, 'body' => $eZui->setTextBox(array('head' => _('範本代號'), 'name' => '', 'value' => 'default', 'req' => true)));
$body[] = array('flex' => 6, 'body' => $eZui->setTextBox(array('head' => _('範本名稱'), 'name' => '', 'value' => '預設範本', 'req' => true)));
$body[] = array('flex' => 12, 'head' => '流程設定', 'body' => $grid);
$html .= $eZui->setGroup(array('body' => $body));

/*
$field   = array();
$field[] = array('head' => _('申請身分'), 'name' => 'b', 'width' => '15%');
$field[] = array('head' => _('功能'), 'name' => 'btn', 'align' => 'right');

$data = array();

foreach ($dataGrid as $key => $value) {
$a = trim($value['a']);
$b = trim($value['b']);

$btn   = array();
$btn[] = $eZui->setBtnHref(array('ex' => 'view', 'small' => true, 'route' => 'm06130_view_grid', 'param' => array($dataMain['a'], 'view', $a)));
$btn[] = $eZui->setBtnHref(array('ex' => 'edit', 'small' => true, 'route' => 'm06130_view_grid', 'param' => array($dataMain['a'], 'edit', $a)));

//顯示
$data[$key]['b']   = $b;
$data[$key]['btn'] = implode('', $btn);
}

$set = array(
'field' => $field,
'data'  => $data,
);

$html .= $eZui->setGrid($set);
 */
?>
{!! $html !!}
{!! $eZui->setValidata('main') !!}
<form>
@endsection
