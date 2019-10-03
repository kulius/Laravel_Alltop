@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')


@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody   = array();

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
    $aBody[] = array("flex" => '2', "body" => $eZui->setComboBox(array("head" => __("所屬大樓"), "name" => "Building", "value" => '', "option" => $aOption, "def" => _("請選擇"))));
    $aBody[] = array("flex" => '2', "body" => $eZui->setComboBox(array("head" => __("所在樓層"), "name" => "Semester_srh", "value" => old("Semester_srh"), "option" => $aOption,"def" => _("請選擇"))));
    $aBody[] = array("flex" => '2', "body" => $eZui->setComboBox(array("head" => __("場地類型"), "name" => "DayfgID_srh", "value" => old("DayfgID_srh"), "option" => $aOption,"def" => _("請選擇"))));
    $aBody[] = array("flex" => '2', "body" => $eZui->setComboBox(array("head" => __("場地名稱"), "name" => "ClassTypeID_srh", "value" => old("ClassTypeID_srh"),"option" => $aOption,  "def" => _("請選擇"))));
    $aBody[] = array("flex" => '2', "body" => $eZui->setComboBox(array("head" => __("管理單位"), "name" => "College_srh", "value" => old("College_srh"), "option" => $aOption, "def" => _("請選擇"))));

    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody = array();
    $aBody[] = array("flex" => 'auto', "body" => $eZui->setBtnSubmit(array('ex' => 'search', 'value' => 'search')));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody = array();
    $aBody[] = array("flex" => '12', "body" => $eZui->setEditArea(array("name" => "EditArea", "value" => '')));
    $aBody[] = array("flex" => 'auto', "body" => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aParams = array(
    'aTabInfo' => array(
    'b13130' => array('param' => "", 'title'=>'不開放時段設定', 'view' => $sHtml, 'current' => 'active'),
    'b13130_tab1' => array('param' => "", 'title'=>'不開放備註文字'),
    )
    );
    $sHtml = $eZui->setTab($aParams);
    //echo $sHtml;
    @endphp
        {!! $sHtml !!}
        {!! $eZui->setValidata('main') !!}
</form>
@endsection
