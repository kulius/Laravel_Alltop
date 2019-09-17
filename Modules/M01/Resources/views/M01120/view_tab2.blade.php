@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHtml = null;
    $tHtml = null;
//dd($status);
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


    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody = array();
    $aBody[] = array("flex" => "6", "body" => $eZui->setTextBox(array("head" => __("使用者帳號/名稱"), "name" => "UserAccount", "value" => '教育系')));

    //$sHtml .= $eZui->setHideBox(array("name" => "DayfgID", "value" => $vDayfg["DayfgID"]));
    $tHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody = array();
    $aBody[] = array("flex" => 'auto', "body" => $eZui->setBtnSubmit(array('ex' => 'search', 'value' => 'search')));

    $tHtml .= $eZui->setGroup(array('body' => $aBody));


    $aField = array();
    $aField[] = array('head' => __('使用者帳號'), 'name' => 'UserAccount', 'width' => '10%');
    $aField[] = array('head' => __('名稱'), 'name' => 'Name', 'width' => '20%');
    $aData = array();
    foreach ($data as $skData => $svData) {
        $saaID      =trim($svData['aaID']);
        $sUserAccount      =trim($svData['UserAccount']);
        $sName      =trim($svData['Name']);

        //$aBtn   = array();
        //$aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "m01120view", "param" => array("view", $saaID)));
         //$aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "m01120_view2", "param" => array("edit", $saaID)));

        //隱藏（KEY）
        $aData[$skData]["aaID"] = $saaID;

        //顯示
        $aData[$skData]["UserAccount"]         = $sUserAccount;
        $aData[$skData]["Name"]         = $sName;

//        $aData[$skData]["btn"]              = implode("", $aBtn);
    }

    $aSet = array(
    'field' => $aField,
    'data' => $aData,
    //"btn" => array(""),
    );

    $tHtml .= $eZui->setGridMul($aSet);


    $aParams = array(
    'aTabInfo' => array(
    'm01120_view' => array('param' => array($status,$id), 'title'=>'群組資料' ),
    'm01120_view_tab2' => array('param' => array($status,$id), 'title'=>'群組人員', 'view' => $tHtml, 'current' => 'active'),
    'm01120_view_tab3' => array('param' => array($status,$id), 'title'=>'功能權限', 'show' => 'true'),
    )
    );
    $sHtml .=$eZui->setTab($aParams);


    @endphp
    {!! $sHtml !!}
    {!! $eZui->setValidata('main') !!}
</form>
@endsection
