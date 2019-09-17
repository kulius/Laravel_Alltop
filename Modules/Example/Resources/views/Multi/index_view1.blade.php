@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
@php
    $sHTML = null;
    $bShow = true;

    switch ($status) {
        case 'add':
            $bShow = false;
        case 'edit':
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'e00200')));
            break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'e00200')));
            break;
    }
    $aRoutePar = array($status, $id);

    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array("flex" => 2, "body" => $eZui->setTextBox(array("head" => __("文字方塊"), "name" => "text", "value" => $data['text'])));
    $aBody[] = array("flex" => 2, "body" => $eZui->setTextBox(array("head" => __("文字區塊"), "name" => "textarea", "value" => $data['textarea'])));
    $aBody[] = array("flex" => 2, "body" => $eZui->setNumberBox(array("head" => __("數字方塊"), "name" => "number", "value" => $data['number'])));

    $sHTML .= $eZui->setGroup(array('body' => $aBody));
    $aParams =  array(
                    'aTabInfo' => array(
                        'e00200_view1_post' => array('param' => $aRoutePar, 'title'=>'主檔', 'view' => $sHTML, 'current' => 'active'),
                        'multi_view2_index' => array('param' => $aRoutePar, 'title'=>'明細', 'show' => $bShow),
                    )
                );
    $sHTML = $eZui->setTab($aParams);
@endphp
    {!! $sHTML !!}
    {!! $eZui->setValidata('main') !!}
</form>
@endsection
