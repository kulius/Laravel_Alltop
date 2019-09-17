@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form method='POST' id='index'>
    {{ csrf_field() }}
	@php
    $sHtml = null;

    $aBody   = array();
    $aBody[] = array('flex' => '3', 'body' => $eZui->setJump(array('head' => __('功能啟用/停用紀錄表'),'ex' => 'print', 'url'=>'m01140_Stda', 'param' => array('head' => '功能啟用/停用紀錄表'))));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setJump(array('head' => __('功能授權紀錄表'),'ex' => 'print', 'url'=>'m01140_Stda2', 'param' => array('head' => '功能授權紀錄表'))));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setJump(array('head' => __('功能維護紀錄表'),'ex' => 'print', 'url'=>'m01140_Stda3', 'param' => array('head' => '功能維護紀錄表'))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));


    echo $sHtml;
	@endphp
    {!! $eZui->setValidata('index') !!}
    </form>
@endsection
