@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form method='POST'>
    {{ csrf_field() }}
@php
  $sHtml = null;

  $aBody   = array();
  $aBody[] = array('body' => $eZui->setTextBox(array('head' => __('文字方塊'), 'name' => 'text', 'value' => old('text') )));
  $sHtml .= $eZui->setGroup(array('body' => $aBody));

  $aBody   = array();
  $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'search')));
  $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'e00200_view1', 'param' => array('add'))));
  $sHtml .= $eZui->setGroup(array('body' => $aBody));

  $aField   = array();
  $aField[] = array('head' => __('文字方塊'), 'name' => 'text', 'width' => '15%');
  $aField[] = array('head' => __('文字區塊'), 'name' => 'textarea', 'width' => '20%');
  $aField[] = array('head' => __('數字方塊'), 'name' => 'number', 'width' => '10%');
  $aField[] = array('head' => __('明細文字方塊'), 'name' => 'DetailText', 'width' => '10%');
  $aField[] = array('head' => __('明細文字區塊'), 'name' => 'DetailTextarea', 'width' => '20%');
  $aField[] = array('head' => __('功能'), 'name' => 'btn', 'align' => 'right');

  $aData = array();
  foreach ($data as $key => $value) {
      $sMutiID = trim($value['MutiID']);
      $aData[$key]['MutiID']   = $sMutiID;
      $aData[$key]['text']     = trim($value['text']);
      $aData[$key]['textarea']     = trim($value['textarea']);
      $aData[$key]['number']   = trim($value['number']);
      $aData[$key]['DetailText']     = trim($value['DetailText']);
      $aData[$key]['DetailTextarea']     = trim($value['DetailTextarea']);

      $aBtn   = array();
      $aBtn[] = $eZui->setBtnHref(array('ex' => 'view', 'small' => true, 'route' => 'e00200_view1', 'param' => array('view', $sMutiID)));
      $aBtn[] = $eZui->setBtnHref(array('ex' => 'edit', 'small' => true, 'route' => 'e00200_view1', 'param' => array('edit', $sMutiID)));

      $aData[$key]['btn']      = implode('', $aBtn);
  }

  $aSet = array(
      'field' => $aField,
      'data'  => $aData,
      'btn'   => array('remove', 'excel', 'pdf', 'print'),
  );

  $sHtml .= $eZui->setGridMUL($aSet);
  echo $sHtml;
@endphp
</form>
@endsection
