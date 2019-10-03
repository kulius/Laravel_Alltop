@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody=array();
        switch ($status) {
        case 'add':
        case 'edit':
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'b13220_tab3')));
        break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'b13220_tab3')));
        break;
    }
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody=array();
    $aBody[] = array("head" => _("申請單號"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("Font"))));
    $aBody[] = array("head" => _("場地名稱"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("Font"))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));
    $aBody=array();
    $aBody[] = array("head" => _("借用日期"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("Font"))));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setTextBox(array('head' => __('借用時段'), 'name' => 'text', 'value' => old('text') )));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody=array();
    $aBody[] = array('flex' => '4', 'body' => $eZui->setTextBox(array('head' => __('收費金額'), 'name' => 'text', 'value' => old('text') )));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setTextBox(array('head' => __('發票號碼'), 'name' => 'text', 'value' => old('text') )));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setTextBox(array('head' => __('發票號碼'), 'name' => 'text', 'value' => old('text') )));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));









    @endphp
    {!! $sHtml !!}
    {!! $eZui->setValidata('main') !!}
</form>
@endsection
