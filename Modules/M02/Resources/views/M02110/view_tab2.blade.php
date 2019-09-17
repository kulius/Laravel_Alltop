@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}

@php
    $sHtml = null;
    $tHtml = null;

    switch ($status) {
        case 'add':
        case 'edit':
        //case 'view':
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
            //  $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'click', 'value' => 'back','text'=>'通過')));
              $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'click', 'value' => 'back','text'=>'清除授權群組權限')));
            // // $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'm02110.view2','text'=>'未通過')));
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm02110')));
            //判斷哪個頁簽的編輯頁傳來的Save狀態
            //$aBody[] = array('body' => $eZui->setHideBox(array("name" => "tab", "value" => "tab1")));
        break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm02110')));
        break;
    }


    //$sHtml .= $eZui->setHideBox(array("name" => "DayfgID", "value" => $vDayfg["DayfgID"]));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody = array();
    $aBody[] = array("flex" => "5", "body" => $eZui->setTextBox(array("head" => __("所屬群組"), "name" => "Unit", "value" => '','status'=>'view')));
    $aBody[] = array("flex" => "1", "body" => $eZui->setTextBox(array("head" => __(""), "value" => '<<','status'=>'view')));
    $aBody[] = array("flex" => "1", "body" => $eZui->setTextBox(array("head" => __(""), "value" => '>>','status'=>'view')));
    $aBody[] = array("flex" => "5", "body" => $eZui->setTextBox(array("head" => __("群組"), "name" => "TeacherName", "value" => '','status'=>'view')));

    //$sHtml .= $eZui->setHideBox(array("name" => "DayfgID", "value" => $vDayfg["DayfgID"]));
    $tHtml .= $eZui->setGroup(array('body' => $aBody));

    $aParams = array(
    'aTabInfo' => array(
    'm02110_view' => array('param' =>  array($status,$id), 'title'=>'帳號管理' ),
    'm02110_view_tab2' => array('param' =>  array($status,$id), 'title'=>'所屬群組', 'view' => $tHtml, 'current' => 'active'),
    'm02110_view_tab3' => array('param' => array($status,$id), 'title'=>'個人功能權限', 'show' => 'true'),
    )
    );
    $sHtml .= $eZui->setTab($aParams);


    @endphp
    </form>
@endsection
