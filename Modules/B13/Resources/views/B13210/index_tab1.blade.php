@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHtml = null;
    $aBody=array();
    $aBody[] = array("head" => _("申請單號"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("Font"))));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setTextBox(array('head' => __('申請人姓名'), 'name' => 'text1', 'value' => old('text') )));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setTextBox(array('head' => __('申請人聯絡電話'), 'name' => 'text2', 'value' => old('text') )));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setTextBox(array('head' => __('申請人FAX'), 'name' => 'text3', 'value' => old('text') )));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setTextBox(array('head' => __('申請人EMAIL'), 'name' => 'text4', 'value' => old('text') )));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setTextBox(array('head' => __('申請人行動電話'), 'name' => 'text5', 'value' => old('text') )));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));


    $aBody = array();
    $aBody[] = array("flex" => 'auto', "body" => $eZui->setBtnHref(array('ex' => 'add', 'value' => 'add', 'route' => 'b13210_tab1_view', 'param' => array('add'))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));
    $aBody   = array();


//第一個CARD填寫場地與時段1


    $aOption   = array();
    $aOption[] = array("value" => "1", "text" => _("1"));
    $aOption[] = array("value" => "2", "text" => _("2"));

    $aBody   = array();
    $aBody[] = array('flex' => '3', 'body' => $eZui->setComboBox(array('head' => _('所屬大樓'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇')));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setComboBox(array('head' => _('所在樓層'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇')));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setComboBox(array('head' => _('場地類型'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇')));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setComboBox(array('head' => _('場地名稱'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇',)));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setDateTimeBox(array('head' => _('場佈日期'), 'name' => '7', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇')));

    // "flex" => 4 相對創意布局元件寬度，非螢幕寬
    $aBody1   = array();
    $aBody1[] = array("flex" => 5, "body" =>$eZui->setDateTimeBox(array("name" => "1", "value" => '')));
    $aBody1[] = array("flex" => "2", "body" => $eZui->setFont(array("text" => _("~"))));
    $aBody1[] = array('flex' => 5, 'body' =>$eZui->setDateTimeBox(array('name' => '2', 'value' => old('text') )));
    $sGroup = $eZui->setGroup(array("body" => $aBody1));
    // "flex" => 12 相對螢幕寬度
    $aBody[] = array('flex' => '3', "head" => _("場佈時段"), "body" => $sGroup);
    $aBody[] = array('flex' => '3', 'body' => $eZui->setDateTimeBox(array('head' => _('活動日期'), 'name' => '9', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇')));
    $aBody1   = array();
    $aBody1[] = array("flex" => 5, "body" =>$eZui->setDateTimeBox(array("name" => "3", "value" => '空值', "option" => $aOption, "req" => true, "def" => _("請選擇"))),);
    $aBody1[] = array("flex" => "2", "body" => $eZui->setFont(array("text" => _("~"))));
    $aBody1[] = array('flex' => 5, 'body' =>$eZui->setDateTimeBox(array('name' => '4', 'value' => old('text') )));
    $sGroup = $eZui->setGroup(array("body" => $aBody1));
    // "flex" => 12 相對螢幕寬度
    $aBody[] = array('flex' => '3', "head" => _("活動時段"), "body" => $sGroup);
    $aBody[] = array('flex' => '3', 'body' => $eZui->setDateTimeBox(array('head' => _('撤場日期'), 'name' => '8', 'value' => '')));
    $aBody1   = array();
    $aBody1[] = array("flex" => 5, "body" =>$eZui->setDateTimeBox(array("name" => "5", "value" => '空值', "option" => $aOption, "req" => true, "def" => _("請選擇"))),);
    $aBody1[] = array("flex" => "2", "body" => $eZui->setFont(array("text" => _("~"))));
    $aBody1[] = array('flex' => 5, 'body' =>$eZui->setDateTimeBox(array('name' => '6', 'value' => old('text') )));
    $sGroup = $eZui->setGroup(array("body" => $aBody1));
    // "flex" => 12 相對螢幕寬度
    $aBody[] = array('flex' => '3', "head" => _("撤場時段"), "body" => $sGroup);
    $aBody[] = array("head" => _("場地租借資訊"), "flex" => "6", "body" => $eZui->setFont(array("text" => _("Font"))));
    $sGroup=$eZui->setGroup(array('body' => $aBody));
    $aBody = array();
    $aBody[] = array("flex" => "12", "head" => "填寫場地與時段1" , "body" => $sGroup);
    $sHtml .= $eZui->setCard(array("body" => $aBody));


//第二個CARD填寫場地與時段2


    $aOption   = array();
    $aOption[] = array("value" => "1", "text" => _("1"));
    $aOption[] = array("value" => "2", "text" => _("2"));

    $aBody   = array();
    $aBody[] = array('flex' => '3', 'body' => $eZui->setComboBox(array('head' => _('所屬大樓'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇')));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setComboBox(array('head' => _('所在樓層'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇')));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setComboBox(array('head' => _('場地類型'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇')));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setComboBox(array('head' => _('場地名稱'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇',)));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setDateTimeBox(array('head' => _('場佈日期'), 'name' => '17', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇')));

    // "flex" => 4 相對創意布局元件寬度，非螢幕寬
    $aBody1   = array();
    $aBody1[] = array("flex" => 5, "body" =>$eZui->setDateTimeBox(array("name" => "11", "value" => '')));
    $aBody1[] = array("flex" => "2", "body" => $eZui->setFont(array("text" => _("~"))));
    $aBody1[] = array('flex' => 5, 'body' =>$eZui->setDateTimeBox(array('name' => '12', 'value' => old('text') )));
    $sGroup = $eZui->setGroup(array("body" => $aBody1));
    // "flex" => 12 相對螢幕寬度
    $aBody[] = array('flex' => '3', "head" => _("場佈時段"), "body" => $sGroup);
    $aBody[] = array('flex' => '3', 'body' => $eZui->setDateTimeBox(array('head' => _('活動日期'), 'name' => '19', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇')));
    $aBody1   = array();
    $aBody1[] = array("flex" => 5, "body" =>$eZui->setDateTimeBox(array("name" => "13", "value" => '空值', "option" => $aOption, "req" => true, "def" => _("請選擇"))),);
    $aBody1[] = array("flex" => "2", "body" => $eZui->setFont(array("text" => _("~"))));
    $aBody1[] = array('flex' => 5, 'body' =>$eZui->setDateTimeBox(array('name' => '14', 'value' => old('text') )));
    $sGroup = $eZui->setGroup(array("body" => $aBody1));
    // "flex" => 12 相對螢幕寬度
    $aBody[] = array('flex' => '3', "head" => _("活動時段"), "body" => $sGroup);
    $aBody[] = array('flex' => '3', 'body' => $eZui->setDateTimeBox(array('head' => _('撤場日期'), 'name' => '18', 'value' => '')));
    $aBody1   = array();
    $aBody1[] = array("flex" => 5, "body" =>$eZui->setDateTimeBox(array("name" => "15", "value" => '空值', "option" => $aOption, "req" => true, "def" => _("請選擇"))),);
    $aBody1[] = array("flex" => "2", "body" => $eZui->setFont(array("text" => _("~"))));
    $aBody1[] = array('flex' => 5, 'body' =>$eZui->setDateTimeBox(array('name' => '16', 'value' => old('text') )));
    $sGroup = $eZui->setGroup(array("body" => $aBody1));
    // "flex" => 12 相對螢幕寬度
    $aBody[] = array('flex' => '3', "head" => _("撤場時段"), "body" => $sGroup);
    $aBody[] = array("head" => _("場地租借資訊"), "flex" => "6", "body" => $eZui->setFont(array("text" => _("Font"))));
    $sGroup=$eZui->setGroup(array('body' => $aBody));
    $aBody = array();
    $aBody[] = array("flex" => "12", "head" => "填寫場地與時段2" , "body" => $sGroup);
    $sHtml .= $eZui->setCard(array("body" => $aBody));


//第三個CARD活動資訊選項
    $aBody   = array();
    $aBody[] = array('flex' => '4', 'body' => $eZui->setTextBox(array('head' => _('活動名稱'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇')));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('計畫主持人'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇')));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('參與對象'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇')));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('活動參與人數'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇',)));
    $aBody[] = array("flex" => '4', "head" => _("檢附活動計畫書"),"body" => $eZui->setBtnSubmit(array('ex' => 'import', 'value' => 'import','text'=>'檔案上傳')));
    $aBody[] = array("flex" => '4', "head" => _("場地借用單位具結書簽章"),"body" => $eZui->setBtnSubmit(array('ex' => 'import', 'value' => 'import','text'=>'檔案上傳')));
    $aBody[] = array('flex' => '12', 'body' => $eZui->setTextArea(array('head' => _('內容摘述'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇')));

    $aMemo   = array();
    $aMemo[] = _("申請優惠說明:");
    $aMemo[] = _("1. 顯示申請優惠或免計收場地使用費相關說明。");
    //b->blue, g->green, r->red, y->yellow, i->light-green,d,s,l
    $aBody[] = array('flex' => '12', 'body'=>$eZui->setAlert(array("name"=>"alert","text" => $aMemo, "style" => "r")));
    $sGroup=$eZui->setGroup(array('body' => $aBody));
    $aBody = array();
    $aBody[] = array("flex" => "12", "head" => "活動資訊選填" , "body" => $sGroup);
    $sHtml .= $eZui->setCard(array("body" => $aBody));


//第四個CARD租借理由
    $aBody   = array();
    $aOption = array();
    $aOption[] = array('value' => 1, 'text' => '申請學生活動');
    $aOption[] = array('value' => 2, 'text' => '全校性學術演講');
    $aOption[] = array('value' => 3, 'text' => '系所課程演講');
    $aOption[] = array('value' => 4, 'text' => '課程研討或考試');
    $aBody[] = array('flex' => '12', 'body' => $eZui->setCheckBox(array('head' => _('租借理由'), 'name' => 'check', 'value' => ['check'], 'option' => $aOption, "inline" => true)));
    $sHtml .= $eZui->setCard(array("body" => $aBody));

    $aBody = array();
    $aBody[] = array("flex" => 'auto', "body" => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save','text'=>'送出資料並下載審核文件')));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));
    $aParams = array(
    'aTabInfo' => array(
    'b13210' => array('param' => "", 'title'=>'校內申請借用'),
    'b13210_tab1' => array('param' => "", 'title'=>'訪客申請借用', 'view' => $sHtml, 'current' => 'active'),
    'b13210_tab2' => array('param' => "", 'title'=>'查詢申請進度'),
    )
    );
    $sHtml = $eZui->setTab($aParams);
    @endphp
        {!! $sHtml !!}
        {!! $eZui->setValidata('main') !!}
</form>
@endsection
