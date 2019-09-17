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
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm07120')));
            break;
        case 'edit':
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('text' => '撤單', 'value' => 'ChgStatus')));
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm07120')));
            break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm07120')));
            break;
    }

    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    if($status == 'add'){
        $sFillTime   = date('Y-m-d h:i:s');
        $sDemandNo   = '系統自動產出';
    }else{
        $sFillTime   = $vdata['FillTime'];
        $sDemandNo   = $vdata['DemandNo'];
    }

    $aBody = array();
    $aBody[] = array('flex' => '2', 'body' => $eZui->setTextBox(array('head' => __('編號'), 'name' => 'DemandNo', 'value' => $sDemandNo, 'status' => "view")));
    $aBody[] = array('flex' => '2', 'body' => $eZui->setTextBox(array('head' => __('填表時間'), 'name' => 'FillTime', 'value' => $sFillTime, 'status' => "view")));
    $aBody[] = array('flex' => '2', 'body' => $eZui->setTextBox(array('head' => __('填報人'), 'name' => 'Filler', 'value' => $sLoginUser, 'status' => "view")));
    $aBody[] = array('flex' => '2', 'body' => $eZui->setTextBox(array('head' => __('填報單位'), 'name' => 'FillUnitName', 'value' => $vdata['FillUnitName'], 'status' => "view")));
    $aBody[] = array('flex' => '2', 'body' => $eZui->setTextBox(array('head' => __('電子信箱'), 'name' => 'Email', 'value' => $vdata['Email'], 'status' => "view")));
    $aBody[] = array('flex' => '2', 'body' => $eZui->setTextBox(array('head' => __('電話'), 'name' => 'Tel', 'value' => $vdata['Tel'], 'status' => "view")));
    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array('flex' => '12', 'head' => __('使用者需求描述'));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setTextBox(array('head' => __('系統'), 'name' => 'SystemName', 'value' => $sSystemName, 'status' => "view")));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setComboBox(array('head' => __('功能名稱'), 'name' => 'FunctionName', 'value' => $vdata['FunctionName'], 'option' => $aFunctionName, 'select' => false,'req'=>true)));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setComboBox(array('head' => __('分類'), 'name' => 'Kind', 'value' => $vdata['Kind'], 'option' =>$aKind, 'select' => false,'req'=>true)));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setDateTimeBox(array('head' => __('需求時間'), 'name' => 'DemandTime', 'value' => $vdata['DemandTime'],'req'=>true)));
    $aBody[] = array('flex' => '12', 'body' => $eZui->setTextArea(array('head' => __('需求描述'), 'name' => 'RequireDescript', 'value' => $vdata['RequireDescript'],'req'=>true)));
    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    //TODO  未有檔案上傳模組及功能
    $aBody   = array();
    $aBody[] = array('flex' => '12', 'head' => __('檔案上傳'));
    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array('flex' => '12', 'head' => __('由先傑維護'));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setDateTimeBox(array('head' => __('完成時間'), 'name' => 'CompleteTime', 'value' => $vdata['CompleteTime'])));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => __('處理進度'), 'name' => 'ProcessStatus', 'value' => $vdata['ProcessStatus'], 'option'=> $aProcessStatus, 'select' => false)));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setTextBox(array('head' => __('處理人員'), 'name' => 'ReplyStaff', 'value' => $vdata['ReplyStaff'], 'select' => false)));
    $aBody[] = array('flex' => '12', 'body' => $eZui->setTextArea(array('head' => __('處理狀況'), 'name' => 'ProcessReply', 'value' => $vdata['ProcessReply'])));
    $sHTML .= $eZui->setGroup(array('body' => $aBody));


    $aBody   = array();
    $aBody[] = array('flex' => '12', 'head' => __('行政人員(完成後填寫)'));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => __('完成狀況'), 'name' => 'CompleteStatus', 'value' => $vdata['CompleteStatus'], 'option' => $aCompleteStatus, 'select' => false, "status"=>"view")));
    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    //少了上傳
    @endphp
    {!! $sHTML !!}
    {!! $eZui->setValidata('main') !!}
    </form>
@endsection
