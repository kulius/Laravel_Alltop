@inject('eZui', 'App\Alltop\BaseView')
@extends('layouts.frame_modal')

@section('content')
<form action="" id="index" method="POST">
    {{ csrf_field() }}

@php
$sHtml = null;

$aForm = array();

$sHtml .= $eZui->setHideBox(array('name' => 'jump'));
$aBody=array();
$aOption1[] = array();
$aOption1[] = array('value'=>'1','text'=>_('全選'));
$aOption1[] = array('value'=>'2','text'=>_('新增'));
$aOption1[] = array('value'=>'3','text'=>_('修改'));
$aOption[] = array();
$aOption[] = array('value'=>'1','text'=>_('全選'));
$aOption[] = array('value'=>'2','text'=>_('啟用'));
$aOption[] = array('value'=>'3','text'=>_('停用'));
// $aBody[] = array("flex" => "auto", "body" => $eZui->setComboBox(array("head" => _("學年"), "name" => "ACADYear_srh", "value" => old("ACADYear_srh"), "option" => $aYear, "select" => false, "def" => _("請選擇"), "attr" => array("onchange='form.submit()'"))));
// $aBody[] = array("flex" => "auto", "body" => $eZui->setComboBox(array("head" => _("學期"), "name" => "Semester_srh", "value" => old("Semester_srh"), "option" => $aSemester, "select" => false, "def" => _("請選擇"), "attr" => array("onchange='form.submit()'"))));
	$aBody[] = array("flex" => '3', "body" => $eZui->setComboBox(array("head" => __("異動類型"), "name" => "ChangeKind", "value" =>'', "option" => '', "select" => false)));
	$aBody[] = array("flex" => '3', "body" => $eZui->setComboBox(array("head" => __("功能啟用/停用"), "name" => "FunctionSOrE", "value" =>'', "option" =>'', "select" => false)));

$sHtml .= $eZui->setGroup(array("body" => $aBody));


$aBody=array();
 $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'excel', 'value' => 'excel')));
//$aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'pdf', 'value' => 'pdf')));
$sHtml .= $eZui->setGroup(array("body" => $aBody));

echo $sHtml;

@endphp

</form>
{!! $eZui->setValidata('index') !!}
@endsection
