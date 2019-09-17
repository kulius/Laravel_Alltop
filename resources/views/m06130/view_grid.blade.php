@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id="main" method='POST'>
{{ csrf_field() }}
<?php
$html = null;

$body   = array();
$body[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
$body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm06130_view', 'param' => array('add'))));

$html .= $eZui->setGroup(array('body' => $body));

$option   = array();
$option[] = array('value' => 'role', 'text' => '角色');
$option[] = array('value' => 'job', 'text' => '單位/職稱');
$option[] = array('value' => 'people', 'text' => '人員');

$body   = array();
$body[] = array('flex' => 12, 'body' => $eZui->setRadioBox(array('head' => _('關卡類別'), 'name' => 'level_type', 'value' => $dataMain['level_type'], 'option' => $option, 'attr' => array('onclick=submit();'), 'inline' => true, 'req' => true)));

switch ($dataMain['level_type'][0]) {
    case 'role':
        $option   = array();
        $option[] = array('value' => '1', 'text' => '職務代理人');
        $option[] = array('value' => '2', 'text' => '所屬主管');
        $option[] = array('value' => '3', 'text' => '所屬主管（包含上級）');
        $option[] = array('value' => '4', 'text' => '所屬導師');

        $body[] = array('flex' => 12, 'body' => $eZui->setComboBox(array('head' => _('角色選擇'), 'name' => '', 'value' => '', 'def' => '請選擇', 'option' => $option, 'req' => true)));
        break;
    case 'job':
        $option   = array();
        $option[] = array('value' => '1', 'text' => '人事室');
        $option[] = array('value' => '2', 'text' => '教務處');
        $option[] = array('value' => '3', 'text' => '會計室');

        $body[] = array('flex' => 6, 'body' => $eZui->setComboBox(array('head' => _('單位選擇'), 'name' => '', 'value' => '', 'def' => '請選擇', 'option' => $option, 'req' => true)));

        $option   = array();
        $option[] = array('value' => '1', 'text' => '組長');
        $option[] = array('value' => '2', 'text' => '副組長');
        $option[] = array('value' => '3', 'text' => '辦事員');

        $body[] = array('flex' => 6, 'body' => $eZui->setComboBox(array('head' => _('職稱選擇'), 'name' => '', 'value' => '', 'def' => '請選擇', 'option' => $option, 'req' => true)));
        break;
    case 'people':
        $body[] = array('flex' => 12, 'body' => $eZui->setJumpSel(array('head' => _('人員選擇'), 'name' => 'jump', 'value' => '', 'option' => '', 'url' => '', 'param' => array('head' => '資料選擇'), 'req' => true)));
        break;
}

$field = array();
//$field[] = array('head' => _('序'), 'name' => 'a', 'width' => '5%');
$field[] = array('head' => _('條件欄位'), 'name' => 'b');
$field[] = array('head' => _('比對方式'), 'name' => 'c', 'width' => '15%');
$field[] = array('head' => _('條件內容'), 'name' => 'd');

$option_b   = array();
$option_b[] = array('value' => '', 'text' => '請選擇');
$option_b[] = array('value' => '1', 'text' => '請假天數');
$option_b[] = array('value' => '2', 'text' => '租借區域');
$option_b[] = array('value' => '3', 'text' => '租借天數');

$option_c   = array();
$option_c[] = array('value' => '', 'text' => '請選擇');
$option_c[] = array('value' => '<', 'text' => '大於');
$option_c[] = array('value' => '>', 'text' => '小於');
$option_c[] = array('value' => '=', 'text' => '等於');
$option_c[] = array('value' => '>=', 'text' => '大於等於');
$option_c[] = array('value' => '<=', 'text' => '大於等於');
$option_c[] = array('value' => 'like', 'text' => '包含');
$option_c[] = array('value' => 'nlike', 'text' => '不包含');

$efield   = array();
$efield[] = array('head' => _('條件欄位'), 'name' => 'b', 'type' => 'combo', 'option' => $option_b);
$efield[] = array('head' => _('比對方式'), 'name' => 'c', 'type' => 'combo', 'option' => $option_c);
$efield[] = array('head' => _('條件內容'), 'name' => 'd');

$data = array();

foreach ($dataGrid as $key => $value) {
    //$a = trim($value['a']);
    $b = trim($value['b']);
    $c = trim($value['c']);
    $d = trim($value['d']);

    //顯示
    //$data[$key]['a'] = $a;
    $data[$key]['b'] = $b;
    $data[$key]['c'] = $c;
    $data[$key]['d'] = $d;
}

$set = array(
    'field'  => $field,
    'efield' => $efield,
    'data'   => $data,
    'btn'    => array('add', 'edit', 'remove'),
);

$group  = $eZui->setEGrid($set);
$body[] = array('flex' => 12, 'head' => _('關卡條件'), 'body' => $group);

$html .= $eZui->setGroup(array('body' => $body));
?>
{!! $html !!}
{!! $eZui->setValidata('main') !!}
<form>
@endsection
