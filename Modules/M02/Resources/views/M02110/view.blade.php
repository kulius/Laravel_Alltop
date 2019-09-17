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

    $aOption   = array();
    $aOption[] = array("value" => "1", "text" => _("檢查"));
    $aOption[] = array("value" => "2", "text" => _("不檢查"));

    $aBody = array();
    $aBody[] = array("flex" => "3", "body" => $eZui->setComboBox(array("head" => __("授權狀態"), "name" => "Unit", "value" => '','option'=>'')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setDateBox(array("head" => __("有效日期"), "name" => "TeacherName", "value" => '')));
    $aBody[] = array("flex" => "6", "body" => $eZui->setRadioBox(array("head" => _("檢查登入IP"), "name" => "radio_inline", "value" => "", "option" => $aOption, "inline" => true)));

    $aBody[] = array("flex" => "3", "body" => $eZui->setTextArea(array("head" => __("授權IP"), "name" => "aa", "value" => '','option'=>$aOption)));
    $aBody[] = array("flex" => "3", "body" => $eZui->setTextArea(array("head" => __("備註"), "name" => "bb", "value" => '5')));
    $tHtml .= $eZui->setGroup(array('body' => $aBody));
    $aParams = array(
    'aTabInfo' => array(
    'm02110_view' => array('param' => array($status,$id), 'title'=>'帳號管理', 'view' => $tHtml, 'current' => 'active'),
    'm02110_view_tab2' => array('param' =>  array($status,$id), 'title'=>'所屬群組', 'show' => 'true'),
    'm02110_view_tab3' => array('param' => array($status,$id), 'title'=>'個人功能權限', 'show' => 'true'),

    )

);

    $aBody   = array();
    $aBody[] = array('flex' => '3', 'body' => $eZui->setTextBox(array('head' => __('帳號'), 'name' => 'Account', 'value' => '123', 'status' => 'view')));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setTextBox(array('head' => __('名稱'), 'name' => 'Name', 'value' => '234', 'status' => 'view')));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setTextBox(array('head' => __('備註'), 'name' => 'Notes', 'value' => '456', 'status' => 'view')));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $sHtml .= $eZui->setTab($aParams);



    $aMemo   = array();
    $aMemo[] = $eZui->setFont(array("text" => _("備註："), "style" => "r"));
    $aMemo[] = _("1. 從人事系統來的資料，只能改備註；計中新增的測試資料就可維護所有欄位");
    $sHtml .= $eZui->setAlert(array("text" => $aMemo, "style" => "y"));

    echo $sHtml;


    @endphp

</form>
@endsection
