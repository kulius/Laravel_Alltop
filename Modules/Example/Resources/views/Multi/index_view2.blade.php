@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form method='POST'>
    {{ csrf_field() }}
@php
  $sHtml = null;
  $aRoutePar = array($status, $id);

  $aBody   = array();
  $aBody[] = array('body' => $eZui->setTextBox(array('head' => __('文字方塊'), 'name' => 'text', 'value' => old('text') )));
  $sHtml .= $eZui->setGroup(array('body' => $aBody));

  $aBody   = array();
  $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'search')));
  if($status != 'view'){
      $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'e00200_view2', 'param' => array('add'))));
  }
  $sHtml .= $eZui->setGroup(array('body' => $aBody));

  $aField   = array();
  $aField[] = array('head' => __('明細文字方塊'), 'name' => 'text', 'width' => '40%');
  $aField[] = array('head' => __('明細文字區塊'), 'name' => 'textarea', 'width' => '40%');
  $aField[] = array('head' => __('功能'), 'name' => 'btn', 'align' => 'right');

  $aData = array();
  foreach ($data as $key => $value) {
      // $sMutiID = trim($value['MutiID']);
      $aData[$key]['MutiID']   = trim($value['MutiID']);
      $aData[$key]['text']     = trim($value['text']);
      $aData[$key]['textarea']     = trim($value['textarea']);

      $sDetailID = trim($value['DetailID']);

      $aBtn   = array();
      $aBtn[] = $eZui->setBtnHref(array('ex' => 'view', 'small' => true, 'route' => 'e00200_view2', 'param' => array('view', $sDetailID)));
      if($status != 'view'){
          $aBtn[] = $eZui->setBtnHref(array('ex' => 'edit', 'small' => true, 'route' => 'e00200_view2', 'param' => array('edit', $sDetailID)));
      }

      $aData[$key]['btn'] = implode('', $aBtn);
  }

  $aSet = array(
      'field' => $aField,
      'data'  => $aData,
      'btn'   => array('remove', 'excel', 'pdf', 'print'),
  );

  $sHtml .= $eZui->setGridMUL($aSet);
  $aParams =  array(
                'aTabInfo' => array(
                    'e00200_view1_post' => array('param' => $aRoutePar, 'title'=>'主檔'),
                    'multi_view2_index' => array('param' => $aRoutePar, 'title'=>'明細', 'view' => $sHtml, 'show' => 'true', 'current' => 'active'),
                )
            );
  $sHtml = $eZui->setTab($aParams);
  echo $sHtml;
@endphp
</form>
@endsection
