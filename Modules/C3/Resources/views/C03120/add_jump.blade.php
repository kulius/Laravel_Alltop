@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.frame_modal')

@section('content')
    <form method='POST' id='index'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

	$aBody   = array();
    $aBody[] = array('flex' => '12', 'body' => $eZui->setTextBox(array('head' => __('項目編號'), 'name' => 'text1', 'value' => old('text1') )));
    $aBody[] = array('flex' => '12', 'body' => $eZui->setTextBox(array('head' => __('項目名稱'), 'name' => 'text2', 'value' => old('text2') )));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnClass(array("ex" => "save", "value" => "save")));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    echo $sHtml;
    @endphp
    {!! $eZui->setValidata('index') !!}
    </form>
@endsection
