@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody = array();
    // $aBody2   = array();
    // $aBody2[] = array("flex" => "auto", "body" => $eZui->setDateBox(array("name" => "SDate_srh", "value" => '')));
    // $aBody2[] = array("flex" => "1", "body" => $eZui->setTextBox(array("value" => '至', "status"=>"view")));
    // $aBody2[] = array("flex" => "auto", "body" => $eZui->setDateBox(array("name" => "EDate_srh", "value" => '')));
    // $sDateHtml = $eZui->setGroup(array('body' => $aBody2));

    // $aBody[] = array("flex" => "6", "head" => __("公告日期範圍"), "body" => $sDateHtml);

    $aBody[] = array("flex" => '3', "body" => $eZui->setComboBox(array("head" => __("學年"), "name" => "ACADYear_srh", "value" =>'', "option" => '', "select" => false)));
    $aBody[] = array("flex" => '3', "body" => $eZui->setComboBox(array("head" => __("學期"), "name" => "Semester_srh", "value" =>'', "option" => '', "select" => false)));
    $aBody[] = array("flex" => '3', "body" => $eZui->setComboBox(array("head" => __("部別"), "name" => "DayfgID_srh", "value" =>'', "option" => '', "select" => false)));
    $aBody[] = array("flex" => '3', "body" => $eZui->setComboBox(array("head" => __("學制"), "name" => "ClassTypeID_srh", "value" =>'', "option" => '', "select" => false)));
    $aBody[] = array("flex" => '3', "body" => $eZui->setComboBox(array("head" => __("學院"), "name" => "CollegeID_srh", "value" =>'', "option" => '', "select" => false)));
    $aBody[] = array("flex" => '3', "body" => $eZui->setComboBox(array("head" => __("系所"), "name" => "UnitID_srh", "value" =>'', "option" => '', "select" => false)));
    $aBody[] = array("flex" => '3', "body" => $eZui->setComboBox(array("head" => __("組別"), "name" => "StudyGroup_srh", "value" =>'', "option" => '', "select" => false)));
    $aBody[] = array("flex" => '3', "body" => $eZui->setComboBox(array("head" => __("年級"), "name" => "Grade_srh", "value" =>'', "option" => '', "select" => false)));
    $aBody[] = array("flex" => '3', "body" => $eZui->setComboBox(array("head" => __("班級"), "name" => "ClassID_srh", "value" =>'', "option" => '', "select" => false)));
    $aBody[] = array("flex" => '3', "body" => $eZui->setTextBox(array("head" => __("帳號/姓名"), "name" => "AccountOrName_srh", "value" =>'', "select" => false)));
    $aBody[] = array("flex" => '3', "body" => $eZui->setTextBox(array("head" => __("所屬單位"), "name" => "BelongUnit_srh", "value" =>'', "select" => false)));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody = array();
    $aBody[] = array("flex" => 'auto', "body" => $eZui->setBtnSubmit(array('ex' => 'search', 'value' => 'search')));
    //$aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'm02130_view', 'param' => array('add'))));
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'click','value'=>'back' ,'text' => '執行密碼還原')));

    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aField = array();
    $aField[] = array('head' => __('帳號'), 'name' => 'Account', 'width' => '10%');
    $aField[] = array('head' => __('姓名'), 'name' => 'Name', 'width' => '20%');
    $aField[] = array('head' => __('所屬單位/系所'), 'name' => 'BelongUnit', 'width' => '20%');
    $aField[] = array('head' => __('管理員姓名'), 'name' => 'AdminName', 'width' => '20%');
    //$aField[] = array("head" => __("功能"), "name" => "btn", "align" => "right", 'width' => '20%');
    $aData = array();
    foreach ($data as $skData => $svData) {
        $saaID      =trim($svData['aaID']);
        $sAccount      = trim($svData["Account"]);
        $sName      = trim($svData["Name"]);
        $sBelongUnit     = trim($svData["BelongUnit"]);
        $sAdminName     = trim($svData["AdminName"]);

       // $aBtn   = array();
       //  $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "m02130_view", "param" => array("view", $saaID)));
       // $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "m02130_view", "param" => array("edit", $saaID)));

        //隱藏（KEY）
        $aData[$skData]["aaID"] = $saaID;

        //顯示
        $aData[$skData]["Account"]         = $sAccount;
        $aData[$skData]["Name"]         = $sName;
        $aData[$skData]["BelongUnit"]        = $sBelongUnit;
        $aData[$skData]["AdminName"]        = $sAdminName;

       // $aData[$skData]["btn"]              = implode("", $aBtn);
    }

    $aSet = array(
    'field' => $aField,
    'data' => $aData,
    //"btn" => array("remove"),
    );

    $sHtml .= $eZui->setGridMul($aSet);

    $aParams = array(
    'aTabInfo' => array(
    'm02130' => array('param' => "", 'title'=>'密碼還原作業', 'view' => $sHtml, 'current' => 'active'),
    'm02130_tab2' => array('param' => "", 'title'=>'授權設定', 'show' => 'true'),
    )
    );
    $sHtml = $eZui->setTab($aParams);

    $aMemo   = array();
    $aMemo[] = $eZui->setFont(array("text" => _("備註："), "style" => "r"));
    $aMemo[] = _("1. 如為管理員還原，管理員姓名欄位就會顯示。");
    $sHtml .= $eZui->setAlert(array("text" => $aMemo, "style" => "y"));



    //echo $sHtml;
    @endphp
        {!! $sHtml !!}
        {!! $eZui->setValidata('main') !!}
</form>
@endsection
