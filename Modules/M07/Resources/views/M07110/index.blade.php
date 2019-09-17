@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form method='POST'>
    {{ csrf_field() }}
	@php
    $sHtml = null;

    //填報時間
    $aBody   = array();
    $aBody[] = array("flex" => 5, "body" => $eZui->setTimeBox(array("name" => "FillTimeStart", "value" => old('FillTimeStart'))));
    $aBody[] = array("flex" => 2, "body" => $eZui->setTextBox(array("value" => '～', "status" => "view")));
    $aBody[] = array("flex" => 5, "body" => $eZui->setTimeBox(array("name" => "FillTimeEnd", "value" => old('FillTimeEnd'))));
    $sGroup = $eZui->setGroup(array("body" => $aBody));

    //需求時間
    $aBody   = array();
    $aBody[] = array("flex" => 5, "body" => $eZui->setTimeBox(array("name" => "DemandTimeStart", "value" =>  old('DemandTimeStart'))));
    $aBody[] = array("flex" => 2, "body" => $eZui->setTextBox(array("value" => '～', "status" => "view")));
    $aBody[] = array("flex" => 5, "body" => $eZui->setTimeBox(array("name" => "DemandTimeEnd", "value" => old('DemandTimeEnd'))));
    $sGroup1 = $eZui->setGroup(array("body" => $aBody));

    //查詢
    $aBody   = array();
    $aBody[] = array('flex' => '2', 'body' => $eZui->setTextBox(array('head' => __('編號'), 'name' => 'DemandNo_srh', 'value' => old('DemandNo_srh'))));
    $aBody[] = array('flex' => '1', 'body' => $eZui->setTextBox(array('head' => __('填報人'), 'name' => 'Filler_srh', 'value' => old('Filler_srh'))));
    $aBody[] = array('flex' => '2', 'body' => $eZui->setComboBox(array('head' => __('填報單位'), 'name' => 'FillUnit_srh', 'value' => old('FillUnit_srh') , 'option' =>$aFillUnit, 'select' => false, 'def' => __("請選擇"))));
    $aBody[] = array('flex' => '2', 'body' => $eZui->setComboBox(array('head' => __('系統'), 'name' => 'SystemName_srh', 'value' => old('SystemName_srh') , 'option' =>$aSystemName, 'select' => false, 'def' => __("請選擇"), "attr" => array("onchange='form.submit()'"))));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setComboBox(array('head' => __('功能'), 'name' => 'FunctionName_srh', 'value' => old('FunctionName_srh') , 'option' =>$aFunctionName, 'select' => false, 'def' => __("請選擇"))));
    $aBody[] = array('flex' => '1', 'body' => $eZui->setComboBox(array('head' => __('分類'), 'name' => 'Kind_srh', 'value' => old('Kind_srh') , 'option' => $aKind , 'select' => false, 'def' => __("請選擇"))));
    $aBody[] = array('flex' => '1', 'body' => $eZui->setComboBox(array('head' => __('查看範圍'), 'name' => 'Range_srh', 'value' =>old('Range_srh') , 'option' =>$aRange ,  'select' => false, "attr" => array("onchange='form.submit()'"))));
    $aBody[] = array('flex' => '2', 'body' => $eZui->setComboBox(array('head' => __('處理進度'), 'name' => 'ProcessStatus_srh', 'value' => old('ProcessStatus_srh')  , 'option'=>$aProcessStatus , 'select' => false, 'def' => __("請選擇"))));
    $aBody[] = array('flex' => '2', 'body' => $eZui->setComboBox(array('head' => __('完成狀況'), 'name' => 'CompleteStatus_srh', 'value' => old('CompleteStatus_srh'), 'option' =>$aCompleteStatus, 'select' => false, 'def' => __("請選擇"))));
    $aBody[] = array('flex' => '4', "head" => _("填表時間起迄"), 'body' => $sGroup);
    $aBody[] = array('flex' => '4', "head" => _("需求時間起迄"), 'body' => $sGroup1);

    $aBody[] = array('flex' => '4', 'body' => $eZui->setTextBox(array('head' => __('需求與處理描述關鍵字'), 'name' => 'ProcessReply_srh', 'value' => old('ProcessReply_srh'), 'select' => false)));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'search')));

    if(isset(old("SystemName_srh")[0])){
        $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'm07110_view', 'param' => array('add','?SystemName='. old('SystemName_srh')[0]))));
    } else {
        $aBody[] = array('flex' => 'auto', 'body' => $eZui->setFont(array('text' => '新增前請先選系統!', 'style' => 'r')));
    }

    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('text' => '資料匯出')));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

	$aField   = array();
    $aField[] = array('head' => __('功能'), 'name' => 'btn');
    $aField[] = array('head' => __('編號'), 'name' => 'DemandNo', 'width' => '5%');
    $aField[] = array('head' => __('填表時間'), 'name' => 'FillTime', 'width' => '5%');
    $aField[] = array('head' => __('填報人'), 'name' => 'Filler', 'width' => '5%');
    $aField[] = array('head' => __('電子信箱'), 'name' => 'Email', 'width' => '5%');
    $aField[] = array('head' => __('電話'), 'name' => 'Tel', 'width' => '5%');
    $aField[] = array('head' => __('系統'), 'name' => 'SystemName', 'width' => '5%');
    $aField[] = array('head' => __('功能名稱'), 'name' => 'FunctionName', 'width' => '5%');
    $aField[] = array('head' => __('分類'), 'name' => 'Kind', 'width' => '5%');
    $aField[] = array('head' => __('需求描述'), 'name' => 'RequireDescript', 'width' => '5%');
    $aField[] = array('head' => __('需求時間'), 'name' => 'ApplyDate', 'width' => '5%');
    $aField[] = array('head' => __('完成時間'), 'name' => 'CompleteTime', 'width' => '5%');
    $aField[] = array('head' => __('處理狀況'), 'name' => 'ProcessReply', 'width' => '5%');
    $aField[] = array('head' => __('處理進度'), 'name' => 'ProcessStatus', 'width' => '5%');
    $aField[] = array('head' => __('處理人員'), 'name' => 'ReplyStaff', 'width' => '5%');
    $aField[] = array('head' => __('完成狀況'), 'name' => 'CompleteStatus', 'width' => '5%');


    $aData = array();

    foreach ($data as $skData => $svData) {
         $sID = trim($svData['ID']);
         $sPNO = trim($svData['PNO']);
         $sDemandNo        = trim($svData['DemandNo']);
         $sFillTime        = trim($svData['FillTime']);
         $sFiller          = trim($svData['Filler']);
         $sEmail           = trim($svData['Email']);
         $sTel             = trim($svData['Tel']);
         $sSystemName      = trim($svData['SystemName']);
         $sFunctionName    = trim($svData['FunctionName']);
         $sKind            = trim($svData['Kind']);
         $sRequireDescript = trim($svData['RequireDescript']);
         $sApplyDate       = trim($svData['ApplyDate']);
         $sCompleteTime    = trim($svData['CompleteTime']);
         $sProcessReply    = trim($svData['ProcessReply']);
         $sProcessStatus   = trim($svData['ProcessStatus']);
         $sReplyStaff      = trim($svData['ReplyStaff']);
         $sCompleteStatus  = trim($svData['CompleteStatus']);

        $aBtn   = array();
        $aBtn[] = $eZui->setBtnHref(array('ex' => 'view', 'small' => true, 'route' => 'm07110_view', 'param' => array('view',$sID."?PNO=".$sPNO)));
        $aBtn[] = $eZui->setBtnHref(array('ex' => 'edit', 'small' => true, 'route' => 'm07110_view', 'param' => array('edit',$sID."?PNO=".$sPNO)));

        //隱藏
        $aData[$skData]['ID'] = $sID;
        $aData[$skData]['PNO'] = $sPNO;
        //顯示
        $aData[$skData]['DemandNo']        = $sDemandNo;
        $aData[$skData]['FillTime']        = $sFillTime;
        $aData[$skData]['Filler']          = $sFiller;
        $aData[$skData]['Email']           = $sEmail;
        $aData[$skData]['Tel']             = $sTel;
        $aData[$skData]['SystemName']      = $sSystemName;
        $aData[$skData]['FunctionName']    = $sFunctionName;
        $aData[$skData]['Kind']            = $sKind;
        $aData[$skData]['RequireDescript'] = $sRequireDescript;
        $aData[$skData]['ApplyDate']       = $sApplyDate;
        $aData[$skData]['CompleteTime']    = $sCompleteTime;
        $aData[$skData]['ProcessReply']    = $sProcessReply;
        $aData[$skData]['ProcessStatus']   = $sProcessStatus;
        $aData[$skData]['ReplyStaff']      = $sReplyStaff;
        $aData[$skData]['CompleteStatus']  = $sCompleteStatus;
        $aData[$skData]['btn']             = implode('', $aBtn);
	   }

	$aSet = array(
        'field' => $aField,
        'data'  => $aData,
        'btn'   => array('remove'),
    );

    $sHtml .= $eZui->setGridMul($aSet);

    echo $sHtml;
	@endphp
    </form>
@endsection
