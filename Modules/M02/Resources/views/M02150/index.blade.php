@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form method='POST' id='index'>
    {{ csrf_field() }}
	@php
    $sHtml = null;

    $aBody   = array();
    $aBody[] = array('flex' => '3', 'body' => $eZui->setJump(array('head' => __('登入紀錄表'),'ex' => 'print', 'url'=>'m02150_Stda', 'param' => array('head' => '登入紀錄表'))));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setJump(array('head' => __('帳號啟用/停用紀錄表'),'ex' => 'print', 'url'=>'m02150_Stda2', 'param' => array('head' => '帳號啟用/停用紀錄表'))));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setJump(array('head' => __('密碼異動紀錄表'),'ex' => 'print', 'url'=>'m02150_Stda3', 'param' => array('head' => '密碼異動紀錄表'))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));


    echo $sHtml;
	@endphp
    {!! $eZui->setValidata('index') !!}
    </form>
@endsection
