@inject('eZui', 'App\Alltop\BaseView')
@extends('layouts.frame_modal')

@section('content')
<form action="" id="index" method="POST">
    {{ csrf_field() }}

@php
$sHtml = null;

$aForm = array();

$sHtml .= $eZui->setHideBox(array('name' => 'jump'));

$aOption1[] = array();
$aOption1[] = array('value'=>'1','text'=>_('全選'));
$aOption1[] = array('value'=>'2','text'=>_('授權'));
$aOption1[] = array('value'=>'3','text'=>_('停權'));
$aBody=array();

    $aBody[] = array("flex" => '3', "body" => $eZui->setDateTimeBox(array("head" => __("異動日期(起)"), "name" => "ChangeSDate", "value" =>'', "select" => false)));
    $aBody[] = array("flex" => '3', "body" => $eZui->setDateTimeBox(array("head" => __("異動日期(迄)"), "name" => "ChangeEDate", "value" =>'', "select" => false)));
    $aBody[] = array("flex" => '3', "body" => $eZui->setComboBox(array("head" => __("異動類型"), "name" => "ChangeKind", "value" =>'', "option" => '', "select" => false)));
    $aBody[] = array("flex" => '3', "body" => $eZui->setTextBox(array("head" => __("異動人員"), "name" => "ChangeKind", "value" =>'', "select" => false)));

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
