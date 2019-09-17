@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form method='POST'>
    {{ csrf_field() }}
	@php
    $sHtml = null;

    $aBody   = array();
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array('flex' => '12', 'body' => $eZui->setTextBox(array('head' => __('學校名稱'), 'name' => 'customer_name', 'value' => $customer_name['content'] )));
    $aBody[] = array('flex' => '12', 'body' => $eZui->setTextBox(array('head' => __('學校英文名稱'), 'name' => 'customer_engname', 'value' => $customer_engname['content'] )));
    $aBody[] = array('flex' => '12', 'body' => $eZui->setTextBox(array('head' => __('學校代碼'), 'name' => 'customer_code', 'value' => $customer_code['content'] )));
    $aBody[] = array('flex' => '12', 'body' => $eZui->setTextBox(array('head' => __('學校簡稱'), 'name' => 'customer_alias', 'value' => $customer_alias['content'] )));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    echo $sHtml;
	@endphp
    </form>
@endsection
