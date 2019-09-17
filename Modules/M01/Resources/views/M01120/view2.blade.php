@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHTML = null;

    switch ($status) {
        case 'add':
        case 'edit':
        //case 'view':
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
            //  $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'click', 'value' => 'back','text'=>'通過')));
            //  $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'click', 'value' => 'back','text'=>'不通過')));
            // // $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'b14210.view2','text'=>'未通過')));
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'b14210_view_tab2')));
            //判斷哪個頁簽的編輯頁傳來的Save狀態
            //$aBody[] = array('body' => $eZui->setHideBox(array("name" => "tab", "value" => "tab1")));
        break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'b14210_view_tab2')));
        break;
    }

    //$sHTML .= $eZui->setHideBox(array("name" => "DayfgID", "value" => $vDayfg["DayfgID"]));
    $sHTML .= $eZui->setGroup(array('body' => $aBody));

///
    $aBody= array();

    $aBody = array();
    $aBody[] = array("flex" => "3", "body" => $eZui->setTextBox(array("head" => __("減授類別"), "name" => "cc", "value" => '計畫型','status'=>'view')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setTextBox(array("head" => __("設定計畫名稱"), "name" => "cc", "value" => '',)));
    $aBody[] = array("flex" => "3", "body" => $eZui->setDateTimeBox(array("head" => __("執行期間"), "name" => "aa", "value" => '')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setComboBox(array("head" => __("減授學年"), "name" => "aa", "value" => '108','option'=>'')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setTextBox(array("head" => __("減授學期"), "name" => "bb", "value" => '第1學期')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setTextBox(array("head" => __("減授時數"), "name" => "bb", "value" => '')));
    $aBody[] = array("flex" => "3", "body" => $eZui->setComboBox(array("head" => __("可超鐘否"), "name" => "aa", "value" => '是','option'=>'')));
    $sHTML .= $eZui->setGroup(array('body' => $aBody));



    @endphp
    {!! $sHTML !!}
    {!! $eZui->setValidata('main') !!}
</form>
@endsection
