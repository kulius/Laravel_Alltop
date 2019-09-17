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
	$aBody2   = array();
    $aBody2[] = array("flex" => "auto", "body" => $eZui->setDateBox(array("name" => "SDate_srh", "value" => '')));
    $aBody2[] = array("flex" => "1", "body" => $eZui->setTextBox(array("value" => '~', "status"=>"view")));
    $aBody2[] = array("flex" => "auto", "body" => $eZui->setDateBox(array("name" => "EDate_srh", "value" => '')));
    $sDateHtml = $eZui->setGroup(array('body' => $aBody2));

    $aBody[] = array("flex" => "12", "head" => __("日期範圍"), "body" => $sDateHtml);


	$aBody[] = array("flex" => '12', "body" => $eZui->setTextBox(array("head" => __("帳號"), "name" => "Account", "value" =>'', "select" => false)));
    $aBody[] = array("flex" => '12', "body" => $eZui->setComboBox(array("head" => __("登入狀態"), "name" => "SignInState", "value" =>'', "option" =>'', "select" => false)));

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
