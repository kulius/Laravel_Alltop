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
	$aBody[] = array("flex" => '12', "body" => $eZui->setDateTimeBox(array("head" => __("異動日期"), "name" => "Date", "value" =>'', "select" => false)));
    $aBody[] = array("flex" => '12', "body" => $eZui->setTextBox(array("head" => __("帳號"), "name" => "Account", "value" =>'', "select" => false)));
    $aBody[] = array("flex" => '12', "body" => $eZui->setTextBox(array("head" => __("異動人員"), "name" => "ChangeKind", "value" =>'', "select" => false)));

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
