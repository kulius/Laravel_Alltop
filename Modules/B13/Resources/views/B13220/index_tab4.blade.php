@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody = array();
    $aBody[] = array("flex" => 'auto', "body" => $eZui->setBtnSubmit(array('ex' => 'click', 'text' => '申請')));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('所屬大樓'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇', 'attr' => array("onchange=form.submit()"))));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('所在樓層'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇', 'attr' => array("onchange=form.submit()"))));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('場地類型'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇', 'attr' => array("onchange=form.submit()"))));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('場地名稱'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇', 'attr' => array("onchange=form.submit()"))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));
    $aBody   = array();
    $aBody1   = array();
    $aBody1[] = array("flex" => 5, "body" =>$eZui->setDateTimeBox(array("name" => "1", "value" => '')));
    $aBody1[] = array("flex" => "2", "body" => $eZui->setFont(array("text" => _("~"))));
    $aBody1[] = array('flex' => 5, 'body' =>$eZui->setDateTimeBox(array('name' => '2', 'value' => old('text') )));
    $sGroup = $eZui->setGroup(array("body" => $aBody1));
    // "flex" => 12 相對螢幕寬度
    $aBody[] = array('flex' => '4', "head" => _("租借日期起迄"), "body" => $sGroup);
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('租借星期'), 'name' => 'drop', 'value' => '', 'option' => '')));
    $aBody1   = array();
    $aBody1[] = array("flex" => 5, "body" =>$eZui->setDateTimeBox(array("name" => "1", "value" => '')));
    $aBody1[] = array("flex" => "2", "body" => $eZui->setFont(array("text" => _("~"))));
    $aBody1[] = array('flex' => 5, 'body' =>$eZui->setDateTimeBox(array('name' => '2', 'value' => old('text') )));
    $sGroup = $eZui->setGroup(array("body" => $aBody1));
    // "flex" => 12 相對螢幕寬度
    $aBody[] = array('flex' => '4', "head" => _("租借時間"), "body" => $sGroup);

    $aParams = array(
    'aTabInfo' => array(
    'b13220' => array('param' => "", 'title'=>'備用審核'),
    'b13220_tab1' => array('param' => "", 'title'=>'常用審核字彙'),
    'b13220_tab2' => array('param' => "", 'title'=>'借用單號查詢'),
    'b13220_tab3' => array('param' => "", 'title'=>'事務組/出納組'),
    'b13220_tab4' => array('param' => "", 'title'=>'批次週期性申請', 'view' => $sHtml, 'current' => 'active'),
    )
    );
    $sHtml = $eZui->setTab($aParams);
    //echo $sHtml;
    @endphp
        {!! $sHtml !!}
        {!! $eZui->setValidata('main') !!}
</form>
@endsection
