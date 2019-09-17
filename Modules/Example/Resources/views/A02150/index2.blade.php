@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form method='POST'>
    {{ csrf_field() }}
@php
  $sHtml = null;

  $aBody   = array();
  $aBody[] = array("flex" => "4", "body" => $eZui->setComboBox(array("head" => __("報部單位"), "name" => "EducationDepartment",
   "value" => $_POST['EducationDepartment'] ?? null, "option" => $aEducationDepartment, "select" => false, "def" => '-')));

  $sHtml .= $eZui->setGroup(array('body' => $aBody));

  $aBody   = array();
  $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'search', 'value' => 'search')));
  $sHtml .= $eZui->setGroup(array('body' => $aBody));

  $aField   = array();
  $aField[] = array('head' => __('功能'), 'name' => 'btn', 'width' => '10%');
  $aField[] = array('head' => __('報部單位'), 'name' => 'EducationDepartment', 'width' => '30%');
  $aField[] = array('head' => __('教育部群組名稱'), 'name' => 'GroupName', 'width' => '30%');
  $aField[] = array('head' => __('教育部群組代碼'), 'name' => 'GroupCode', 'width' => '20%');
  $aField[] = array('head' => __('狀態'), 'name' => 'GroupState', 'width' => '10%');

  $aData = array();
  foreach ($data as $skData => $svData) {
      //隱藏（KEY）
      $aData[$skData]["DataGroupID"] = trim($svData["DataGroupID"]);

      //顯示
      $aBtn   = array();
      $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "e00304_view2",
       "param" => array("edit", trim($svData["DataGroupID"]))));

      $aData[$skData]["EducationDepartment"]     = trim($svData["EducationDepartment"]);
      $aData[$skData]["GroupName"]                    = trim($svData["GroupName"]);
      $aData[$skData]["GroupCode"]                    = trim($svData["GroupCode"]);
      if(trim($svData['GroupState']) == '1'){
          $state = '使用中';
      }else if (trim($svData['GroupState']) == '0'){
          $state = '<span style="color: red;">停用</span>';
      }
      $aData[$skData]["GroupState"]         = $state;

      $aData[$skData]["btn"] = implode("", $aBtn);
  }

  $aSet = array(
      'field' => $aField,
      'data'  => $aData,
  );

  $sHtml .= $eZui->setGrid($aSet);

    $aParams =  array(
                'aTabInfo' => array(
                    'e00304' => array('title'=>'教育部代碼'),
                    'e00304_index2' => array('title'=>'教育部代碼群組', 'view' => $sHtml, 'current' => 'active'),
                )
            );
    $sHtml = $eZui->setTab($aParams);
  echo $sHtml;
@endphp
</form>
@endsection
