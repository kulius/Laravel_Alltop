@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    // $aBody2   = array();
    // $aBody2[] = array("flex" => "auto", "body" => $eZui->setDateBox(array("name" => "AbsentSDate_srh", "value" => '')));
    // $aBody2[] = array("flex" => "1", "body" => $eZui->setTextBox(array("value" => '至', "status"=>"view")));
    // $aBody2[] = array("flex" => "auto", "body" => $eZui->setDateBox(array("name" => "AbsentEDate_srh", "value" => '')));
    // $sDateHtml = $eZui->setGroup(array('body' => $aBody2));

    // $aBody[] = array("flex" => "6", "head" => __("寄信日期起訖"), "body" => $sDateHtml);
    $aBody = array();
    $aBody[] = array("flex" => '3', "body" => $eZui->setComboBox(array("head" => __("職稱"), "name" => "JobName_srh", "value" =>'', "option" => '', "select" => false)));
    $aBody[] = array("flex" => '3', "body" => $eZui->setTextBox(array("head" => __("帳號/名稱"), "name" => "AccountName_srh", "value" =>'', "select" => false)));
    $aBody[] = array("flex" => '3', "body" => $eZui->setComboBox(array("head" => __("授權狀態"), "name" => "AuzState_srh", "value" =>'', "option" => '', "select" => false)));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody = array();
    $aBody[] = array("flex" => 'auto', "body" => $eZui->setBtnSubmit(array('ex' => 'search', 'value' => 'search')));
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'm02110_view', 'param' => array('add'))));
    //$aBody[] = array("flex" => 'auto', "body" => $eZui->setBtnSubmit(array('ex' => 'click', 'route' => 'M02110view2','text'=>'複製資料', 'param' => array('add'))));

    $sHtml .= $eZui->setGroup(array('body' => $aBody));


    $aField = array();
    $aField[] = array('head' => __('帳號'), 'name' => 'Account', 'width' => '10%');
    $aField[] = array('head' => __('職稱'), 'name' => 'JobName', 'width' => '10%');
    $aField[] = array('head' => __('名稱'), 'name' => 'Name', 'width' => '10%');
    $aField[] = array('head' => __('備註'), 'name' => 'Notes', 'width' => '20%');
    $aField[] = array('head' => __('授權'), 'name' => 'Auz', 'width' => '20%');
    $aField[] = array("head" => __("功能"), "name" => "btn", "align" => "right", 'width' => '20%');
    $aData = array();
    foreach ($data as $skData => $svData) {
        $saaID      =trim($svData['aaID']);
        $sAccount      =trim($svData['Account']);
        $sJobName      =trim($svData['JobName']);
        $sName      =trim($svData['Name']);
        $sNotes      =trim($svData['Notes']);
        $sAuz      =trim($svData['Auz']);

        $aBtn   = array();
        $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "m02110_view", "param" => array("view", $saaID)));
         $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "m02110_view", "param" => array("edit", $saaID)));

        //隱藏（KEY）
        $aData[$skData]["aaID"] = $saaID;

        //顯示
        $aData[$skData]["Account"]         = $sAccount;
        $aData[$skData]["JobName"]         = $sJobName;
        $aData[$skData]["Name"]         = $sName;
        $aData[$skData]["Notes"]         = $sNotes;
        $aData[$skData]["Auz"]         = $sAuz;

        $aData[$skData]["btn"]              = implode("", $aBtn);
    }

    $aSet = array(
    'field' => $aField,
    'data' => $aData,
    "btn" => array(""),
    );

    $sHtml .= $eZui->setGridMul($aSet);


    // $aMemo   = array();
    // $aMemo[] = $eZui->setFont(array("text" => _("備註："), "style" => "r"));
    // $aMemo[] = _("1. 是否替換是自動判定");
    // $aMemo[] = _("2. 導師替換擬聘僅對審核通過之資料做修改");
    // $sHtml .= $eZui->setAlert(array("text" => $aMemo, "style" => "y"));



    //echo $sHtml;
    @endphp
        {!! $sHtml !!}
        {!! $eZui->setValidata('main') !!}
</form>
@endsection
