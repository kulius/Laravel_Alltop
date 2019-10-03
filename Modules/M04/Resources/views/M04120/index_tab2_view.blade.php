@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')

@include('layouts.error_tips', array('errors' => $errors))

    <form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
	@php
    $sHtml = null;
    
    switch ($status) {
        case 'edit':
        case 'add':
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm04120_tab2')));

            break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm04120_tab2')));
            break;
    }
    $sHtml .= $eZui->setGroup(array("body" => $aBody));

    $aBody   = array();
    $aBody[] = array("head" => _("多選項試題類型"), "flex" => "2", "body" => $eZui->setFont(array("text" => _("單選"))));
    $aBody[] = array("head" => _("題目"), "flex" => "2", "body" => $eZui->setFont(array("text" => _("請問您最常用哪種瀏覽器登入此系統?"))));
    $aBody[] = array("head" => _("項目編號"), "flex" => "2", "body" => $eZui->setFont(array("text" => _("1"))));
    $aBody[] = array("body" => $eZui->setTextBox(array("head" => _("項目名稱"), "name" => "text", "value" => "")));

    $sHtml .= $eZui->setGroup(array("body" => $aBody));

    $aMemo   = array();
    $aMemo[] = $eZui->setFont(array("text" => _("備註："), "style" => "r"));
    $aMemo[] = _("1.項目編號：新增時，會依現有項目編號最大值自動+1 例:該題已有三個選項，則新增時，項目就會顯示4");
    $aMemo[] = _("2.編輯時，自動帶入該編號並不得修改編號。");

    $sHtml .= $eZui->setAlert(array("text" => $aMemo, "style" => "y"));
	@endphp
    {!! $sHtml !!}
    {!! $eZui->setValidata('main') !!}
    </form>
@endsection
