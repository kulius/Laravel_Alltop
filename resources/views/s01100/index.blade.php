@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form method='POST'>
{{ csrf_field() }}
<?php
$sHTML = null;

$aBody   = array();
$aBody[] = array('body' => $eZui->setComboBox(array('head' => _('參數類別'), 'name' => 'param_class', 'value' => old('param_class'), 'def' => '請選擇', 'option' => $param_class_combo)));

$sHTML .= $eZui->setGroup(array('body' => $aBody));

$aBody   = array();
$aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'search')));
$aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'cmd' => 'add', 'path' => 'main')));

$sHTML .= $eZui->setGroup(array('body' => $aBody));

$aField   = array();
$aField[] = array('head' => _('參數類型'), 'name' => 'param_class', 'width' => '15%');
$aField[] = array('head' => _('參數名稱（英文）'), 'name' => 'param_name', 'width' => '15%');
$aField[] = array('head' => _('參數內容'), 'name' => 'param_content', 'width' => '20%');
$aField[] = array('head' => _('參數備註'), 'name' => 'param_remark', 'width' => '30%');
$aField[] = array('head' => _('功能'), 'name' => 'btn', 'align' => 'right');

$aData = array();

foreach ($dataMain as $skData => $svData) {
    $sContent = trim($svData['param_content']);
    $sName    = trim($svData['param_name']);
    $sRemark  = trim($svData['param_remark']);
    $sClass   = trim($svData['param_class']);

    $aBtn   = array();
    $aBtn[] = $eZui->setBtnHref(array('ex' => 'view', 'small' => true, 'cmd' => 'view', 'path' => 'main', 'param' => array('param_name' => $sName)));
    $aBtn[] = $eZui->setBtnHref(array('ex' => 'edit', 'small' => true, 'cmd' => 'edit', 'path' => 'main', 'param' => array('param_name' => $sName)));

    $aData[$skData]['param_class']   = $sClass;
    $aData[$skData]['param_name']    = $sName;
    $aData[$skData]['param_content'] = $sContent;
    $aData[$skData]['param_remark']  = $sRemark;
    $aData[$skData]['btn']           = implode('', $aBtn);
}

$aSet = array(
    'field' => $aField,
    'data'  => $aData,
    'btn'   => array('remove'),
);

$sHTML .= $eZui->setGridMUL($aSet);
?>
{!! $sHTML !!}
{!! $eZui->setValidata('main') !!}
<form>
@endsection
