@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
	@php
    $sHTML = null;

    switch ($status) {
        case 'add':
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm07110')));
            break;
        case 'edit':
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('text' => '撤單', 'value' => 'ChgStatus')));
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm07110')));
            break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm07110')));
            break;
    }

    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    //新增時，自動帶入現在時間和vuserdata(登錄者資訊)
    if($status == 'add'){
        $sFillTime   = date('Y-m-d h:i:s');
        $sDemandNo   = '系統自動產出';
        $sPNO        = $vuserdata[0]['PNO'];
        $sFiller     = $vuserdata[0]['CNAME'];
        $sFillUnitID = $vuserdata[0]['DEPNO'];
        $sFillUnit   = $vuserdata[0]['DEPNAME'];
        $sEmail      = $vuserdata[0]['EMAIL'];
        $sTel        = $vuserdata[0]['TEL1'];
    }else{
        $sFillTime   = $vdata['FillTime'];
        $sDemandNo   = $vdata['DemandNo'];
        $sPNO        = $vdata['PNO'];
        $sFiller     = $vdata['Filler'];
        $sFillUnitID = $vdata['FillUnit'];
        $sFillUnit   = $vdata['FillUnit'];
        $sEmail      = $vdata['Email'];
        $sTel        = $vdata['Tel'];
    }
    //隱藏欄位(儲存用)
    $sHTML .= $eZui->setHideBox(array("name" => "PNO", "value" => $sPNO));
    $sHTML .= $eZui->setHideBox(array("name" => "FillUnit", "value" => $sFillUnitID));


    $aBody = array();
    $aBody[] = array('flex' => '2', 'body' => $eZui->setTextBox(array('head' => __('編號'), 'name' => 'DemandNo', 'value' => $sDemandNo, 'status' => "view")));
    $aBody[] = array('flex' => '2', 'body' => $eZui->setTextBox(array('head' => __('填表時間'), 'name' => 'FillTime', 'value' => $sFillTime, 'status' => "view")));
    $aBody[] = array('flex' => '2', 'body' => $eZui->setTextBox(array('head' => __('填報人'), 'name' => 'Filler', 'value' => $sFiller, 'status' => "view")));
    $aBody[] = array('flex' => '2', 'body' => $eZui->setTextBox(array('head' => __('填報單位'), 'name' => 'FillUnitName', 'value' => $sFillUnit, 'status' => "view")));
    $aBody[] = array('flex' => '2', 'body' => $eZui->setTextBox(array('head' => __('電子信箱'), 'name' => 'Email', 'value' => $sEmail, 'status' => "view")));
    $aBody[] = array('flex' => '2', 'body' => $eZui->setTextBox(array('head' => __('電話'), 'name' => 'Tel', 'value' => $sTel, 'status' => "view")));
    $sHTML .= $eZui->setGroup(array('body' => $aBody));

	$aBody   = array();
    $aBody[] = array('flex' => '12', 'head' => __('使用者需求描述'));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setTextBox(array('head' => __('系統'), 'name' => 'SystemName', 'value' => $sSystemName, 'status' => "view")));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => __('功能名稱'), 'name' => 'FunctionName', 'value' => $vdata['FunctionName'] , 'option' => $aFunctionName, 'select' => false)));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => __('分類'), 'name' => 'Kind', 'value' => $vdata['Kind'] , 'option' =>$aKind, 'select' => false,'req'=>true)));
    //$aBody[] = array('flex' => '3', 'body' => $eZui->setDateBox(array('head' => __('需求時間'), 'name' => 'DemandTime', 'value' => $vdata['DemandTime'],'req'=>true)));
    $aBody[] = array('flex' => '12', 'body' => $eZui->setTextArea(array('head' => __('需求描述'), 'name' => 'RequireDescript', 'value' => $vdata['RequireDescript'],'req'=>true)));
    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    //TODO  未有檔案上傳模組及功能
    $aBody   = array();
    $aBody[] = array('flex' => '12', 'head' => __('檔案上傳'));
    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array('flex' => '12', 'head' => __('由先傑維護'));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setDateBox(array('head' => __('完成時間'), 'name' => 'CompleteTime', 'value' => $vdata['CompleteTime'], "status"=>"view")));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => __('處理進度'), 'name' => 'ProcessStatus', 'value' => $vdata['ProcessStatus'], 'option'=> $aProcessStatus, 'select' => false, "status"=>"view")));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setTextBox(array('head' => __('處理人員'), 'name' => 'ReplyStaff', 'value' => $vdata['ReplyStaff'], 'select' => false, "status"=>"view")));
    $aBody[] = array('flex' => '12', 'body' => $eZui->setTextArea(array('head' => __('處理狀況'), 'name' => 'ProcessReply', 'value' => $vdata['ProcessReply'], "status"=>"view")));
    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    if($status != 'add'){
        $aBody   = array();
        $aBody[] = array('flex' => '12', 'head' => __('行政人員(完成後填寫)'));
        $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => __('完成狀況'), 'name' => 'CompleteStatus', 'value' => $vdata['CompleteStatus'], 'option' => $aCompleteStatus, 'select' => false)));
        $sHTML .= $eZui->setGroup(array('body' => $aBody));
    }

    //少了上傳
	@endphp
    {!! $sHTML !!}
    {!! $eZui->setValidata('main') !!}
    </form>
@endsection
