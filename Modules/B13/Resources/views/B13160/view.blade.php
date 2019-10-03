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
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'b13160')));
        break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'b13160')));
        break;
    }
    $sHtml .= $eZui->setGroup(array('body' => $aBody));
    $aBody = array();
    $aBody[] = array("flex" => '3', "body" => $eZui->setComboBox(array("head" => __("學年"), "name" => "ACADYear_srh", "value" => $aYear[5], "option" => $aYear, "select" => false,"def" => _("請選擇"))));
    $aBody[] = array("flex" => '3', "body" => $eZui->setComboBox(array("head" => __("學期"), "name" => "Semester_srh", "value" => old("Semester_srh"), "option" => $aSemester,"select" => false,"def" => _("請選擇"))));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setDateTimeBox(array('head' => __('開始申請日期'), 'name' => 'DateTime', 'value' => old('text') )));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setDateTimeBox(array('head' => __('結束申請日期'), 'name' => 'DateTime1', 'value' => old('text') )));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));




    @endphp
    {!! $sHtml !!}
    {!! $eZui->setValidata('main') !!}
</form>
@endsection
