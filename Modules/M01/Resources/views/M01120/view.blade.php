@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHTML = null;
    $tHTML = null;
    switch ($status) {
        case 'add':
        case 'edit':
        //case 'view':
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
            //  $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'click', 'value' => 'back','text'=>'通過')));
            //  $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'click', 'value' => 'back','text'=>'不通過')));
            // // $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'm01120.view2','text'=>'未通過')));
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm01120')));
            //判斷哪個頁簽的編輯頁傳來的Save狀態
            //$aBody[] = array('body' => $eZui->setHideBox(array("name" => "tab", "value" => "tab1")));
        break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm01120')));
        break;
    }
     $sHTML .= $eZui->setGroup(array('body' => $aBody));

    $aBody = array();
    $aBody[] = array("flex" => "12", "body" => $eZui->setTextBox(array("head" => __("群組代碼"), "name" => "GroupNo", "value" => 'admin','status'=>'view')));
    $aBody[] = array("flex" => "12", "body" => $eZui->setTextBox(array("head" => __('群組名稱'), "name" => "GroupName", "value" => '管理者','status'=>'view')));
    $aBody[] = array("flex" => "12", "body" => $eZui->setTextArea(array("head" => __('群組備註'), "name" => "GroupNotes", "value" => '')));

    $tHTML .= $eZui->setGroup(array('body' => $aBody));

    $aParams = array(
    'aTabInfo' => array(
    'm01120_view' => array('param' => array($status,$id), 'title'=>'群組代碼', 'view' => $tHTML, 'current' => 'active'),
    'm01120_view_tab2' => array('param' => array($status,$id), 'title'=>'群組人員', 'show' => 'true'),
    'm01120_view_tab3' => array('param' => array($status,$id), 'title'=>'功能權限', 'show' => 'true'),
    )
    );
    $sHTML .= $eZui->setTab($aParams);


    @endphp
    {!! $sHTML !!}
    {!! $eZui->setValidata('main') !!}
</form>
@endsection
