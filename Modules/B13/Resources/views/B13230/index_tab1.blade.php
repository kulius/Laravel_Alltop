@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aOption   = array();
    $aOption[] = array("value" => "1", "text" => _("1"));
    $aOption[] = array("value" => "2", "text" => _("2"));

    $aBody   = array();
    $aBody[] = array('flex' => '3', 'body' => $eZui->setComboBox(array('head' => _('所屬大樓'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇')));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setComboBox(array('head' => _('所在樓層'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇')));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setComboBox(array('head' => _('場地類型'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇')));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setComboBox(array('head' => _('場地名稱'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇',)));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setComboBox(array('head' => _('管理單位'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇',)));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setDateTimeBox(array('head' => _('租借日期(每次顯示一週)'), 'name' => '17', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇')));

    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody = array();
    $aBody[] = array("flex" => 'auto', "body" => $eZui->setBtnSubmit(array('ex' => 'search', 'value' => 'search')));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aParams = array(
    'aTabInfo' => array(
    'b13230' => array('param' => "", 'title'=>'業務承辦人'),
    'b13230_tab1' => array('param' => "", 'title'=>'多間場地查詢', 'view' => $sHtml, 'current' => 'active'),
    )
    );
    $sHtml = $eZui->setTab($aParams);
    @endphp
        {!! $sHtml !!}
        {!! $eZui->setValidata('main') !!}
</form>
@endsection
