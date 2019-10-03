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
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'b13110')));
        break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'b13110')));
        break;
    }
    $sHtml .= $eZui->setGroup(array('body' => $aBody));
    $sStatus = $status != "add" ? "view" : "";

    $aOption   = array();
    $aOption[] = array("value" => "1", "text" => _("-"));
    $aOption[] = array("value" => "2", "text" => _("行政大樓"));
    $aOption[] = array("value" => "3", "text" => _("科學館"));
    $aOption[] = array("value" => "4", "text" => _("明德樓"));
    $aOption[] = array("value" => "5", "text" => _("芳蘭樓"));
    $aOption[] = array("value" => "6", "text" => _("創意館"));
    $aOption[] = array("value" => "7", "text" => _("視聽館"));
    $aOption[] = array("value" => "8", "text" => _("至善樓"));
    $aOption[] = array("value" => "9", "text" => _("圖書館"));
    $aOption[] = array("value" => "10", "text" => _("體育館"));
    $aOption[] = array("value" => "11", "text" => _("藝術館"));
    $aOption[] = array("value" => "12", "text" => _("篤行樓"));

    $aBody = array();
    $aBody[] = array("flex" => '2', "body" => $eZui->setTextBox(array("head" => __("場地編號"),'status'=>'view', "name" => "Building", "value" => '')));
    $aBody[] = array("flex" => '2', "body" => $eZui->setComboBox(array("head" => __("所屬大樓"),'status'=>'view', "name" => "Semester_srh", "value" => old("Semester_srh"),'req'=>true, "option" => $aOption,"def" => _("請選擇"))));
    $aBody[] = array("flex" => '2', "body" => $eZui->setComboBox(array("head" => __("所在樓層"),'status'=>'view', "name" => "DayfgID_srh", "value" => old("DayfgID_srh"), "option" => $aOption,"def" => _("請選擇"))));
    $aBody[] = array("flex" => '2', "body" => $eZui->setComboBox(array("head" => __("場地類型"),'status'=>'view', "name" => "ClassTypeID_srh", "value" => old("ClassTypeID_srh"),"option" => $aOption,  "def" => _("請選擇"))));
    $aBody[] = array("flex" => '2', "body" => $eZui->setComboBox(array("head" => __("場地名稱"),'status'=>'view', "name" => "College_srh", "value" => old("College_srh"),'req'=>true, "option" => $aOption, "def" => _("請選擇"))));
    $aBody[] = array("flex" => '2', "body" => $eZui->setComboBox(array("head" => __("管理單位"),'status'=>'view', "name" => "College_srh", "value" => old("College_srh"))));
    $aBody[] = array( "flex" => "2", "body" => $eZui->setTextBox(array("head" => _("租金/管理費"))));
    $aBody[] = array("head" => _("空調費用"), "flex" => "2", "body" => $eZui->setTextBox(array('name'=>"123")));
    $aBody[] = array("head" => _("租金單位"), "flex" => "2", "body" => $eZui->setTextBox(array('name'=>"123")));
    $aBody[] = array("head" => _("佈置費用"), "flex" => "2", "body" => $eZui->setTextBox(array('name'=>"123")));
    $aBody[] = array("head" => _("撤場費用"), "flex" => "2", "body" => $eZui->setTextBox(array('name'=>"123")));
    $aBody[] = array("head" => _("保證金"), "flex" => "2", "body" => $eZui->setTextBox(array('name'=>"444")));
    $aBody[] = array("head" => _("容納人數"), "flex" => "2", "body" => $eZui->setTextBox(array('status'=>'view')));
    $aBody[] = array( "flex" => "2", "body" => $eZui->setComboBox(array("head" => _("開放排課"),'status'=>'view','req'=>true,'option'=>$aOption)));
    $aBody[] = array( "flex" => "2", "body" => $eZui->setComboBox(array("head" => _("開放外借"),'status'=>'view','req'=>true,'option'=>$aOption)));
    $aBody[] = array("head" => _("電腦數量"), "flex" => "2", "body" => $eZui->setTextBox(array('status'=>'view')));
    $aOption = array();
    $aOption[] = array('value' => 1, 'text' => '有');
    $aBody[] = array('flex' => '2', 'body' => $eZui->setCheckBox(array('head' => _('有無投影設備'),'status'=>'view', 'name' => 'check', 'value' => ['check'], 'option' => $aOption)));
    $aBody[] = array('flex' => '2', 'body' => $eZui->setCheckBox(array('head' => _('有無音響設備'),'status'=>'view', 'name' => 'check1', 'value' => ['check'], 'option' => $aOption)));
    $aBody[] = array('flex' => '2', 'body' => $eZui->setCheckBox(array('head' => _('有無攝影設備'),'status'=>'view', 'name' => 'check2', 'value' => ['check'], 'option' => $aOption)));
    $aBody[] = array('flex' => '2', 'body' => $eZui->setCheckBox(array('head' => _('有無網路設備'),'status'=>'view', 'name' => 'check3', 'value' => ['check'], 'option' => $aOption)));
    $aBody[] = array('flex' => '2', 'body' => $eZui->setCheckBox(array('head' => _('有無空調設備'),'status'=>'view', 'name' => 'check4', 'value' => ['check'], 'option' => $aOption)));
    $aBody[] = array("head" => _("聯絡人"), "flex" => "2", "body" => $eZui->setTextBox(array('status'=>'view',)));
    $aBody[] = array("head" => _("聯絡人分機"), "flex" => "2", "body" => $eZui->setTextBox(array('status'=>'view',)));
    $aBody[] = array("head" => _("提早預約天數"), "flex" => "2", "body" => $eZui->setTextBox(array('status'=>'view',)));
    $aBody[] = array("head" => _("代理人"), "flex" => "2", "body" => $eZui->setTextBox(array('status'=>'view',)));
    $aBody[] = array("head" => _("代理人分機"), "flex" => "2", "body" => $eZui->setTextBox(array('status'=>'view',)));
    $aBody[] = array("head" => _("設備要目"), "flex" => "12", "body" => $eZui->setTextArea(array('status'=>'view',)));


    $sHtml .= $eZui->setGroup(array('body' => $aBody));







    @endphp
    {!! $sHtml !!}
    {!! $eZui->setValidata('main') !!}
</form>
@endsection
