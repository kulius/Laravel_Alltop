@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody=array();
        switch ($status) {
        case 'add':
        case 'edit':
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'b13220')));
        break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'b13220')));
        break;
    }
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody=array();

    $aBody   = array();
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('審核狀態'), 'name' => 'drop', 'value' => '', 'option' => '')));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('審核字彙'), 'name' => 'drop', 'value' => '', 'option' => '')));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));





//第一個CARD填寫場地與時段1


    $aOption   = array();
    $aOption[] = array("value" => "1", "text" => _("1"));
    $aOption[] = array("value" => "2", "text" => _("2"));
    $aBody = array();
    $aBody=array();
    $aBody[] = array("head" => _("申請人姓名"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("Font"))));
    $aBody[] = array("head" => _("申請人系所"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("Font"))));
    $aBody[] = array("head" => _("申請人單位"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("Font"))));
    $aBody[] = array("head" => _("申請人Email"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("Font"))));
    $aBody[] = array("head" => _("申請人電話"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("Font"))));
    $aBody[] = array("head" => _(""), "flex" => "4", "body" => $eZui->setFont(array("text" => _(""))));
    $aBody[] = array("head" => _("場地名稱"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("Font"))));
    $aBody[] = array("head" => _("租借日期"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("Font"))));
    $aBody[] = array("head" => _("借用時段"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("Font"))));

    $sGroup=$eZui->setGroup(array('body' => $aBody));
    $aBody = array();
    $aBody[] = array("flex" => "12", "head" => "申請人相關資料" , "body" => $sGroup);
    $sHtml .= $eZui->setCard(array("body" => $aBody));

//第二個CARD活動資訊選項
    $aBody   = array();
    $aBody[] = array('flex' => '4', 'body' => $eZui->setTextBox(array('head' => _('活動名稱'), 'name' => 'drop', 'value' => '','status'=>'view')));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('計畫主持人'), 'name' => 'drop', 'value' => '','status'=>'view')));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('參與對象'), 'name' => 'drop', 'value' => '','status'=>'view')));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('活動參與人數'), 'name' => 'drop', 'value' => '','status'=>'view')));
    $aBody[] = array("flex" => '4', "head" => _("檢附活動計畫書"),"body" => $eZui->setBtnSubmit(array('ex' => 'import', 'value' => 'import','text'=>'檔案上傳')));
    $aBody[] = array("flex" => '4', "head" => _("場地借用單位具結書簽章"),"body" => $eZui->setBtnSubmit(array('ex' => 'import', 'value' => 'import','text'=>'檔案上傳')));
    $aBody[] = array('flex' => '12', 'body' => $eZui->setTextArea(array('head' => _('內容摘述'), 'name' => 'drop', 'value' => '','status'=>'view')));

    $aMemo   = array();
    $aMemo[] = _("申請優惠說明:");
    $aMemo[] = _("1. 顯示申請優惠或免計收場地使用費相關說明。");
    //b->blue, g->green, r->red, y->yellow, i->light-green,d,s,l
    $aBody[] = array('flex' => '12', 'body'=>$eZui->setAlert(array("name"=>"alert","text" => $aMemo, "style" => "r")));
    $sGroup=$eZui->setGroup(array('body' => $aBody));
    $aBody = array();
    $aBody[] = array("flex" => "12", "head" => "活動資訊選填" , "body" => $sGroup);
    $sHtml .= $eZui->setCard(array("body" => $aBody));


//第三個CARD租借理由
    $aBody   = array();
    $aOption = array();
    $aOption[] = array('value' => 1, 'text' => '申請學生活動');
    $aOption[] = array('value' => 2, 'text' => '全校性學術演講');
    $aOption[] = array('value' => 3, 'text' => '系所課程演講');
    $aOption[] = array('value' => 4, 'text' => '課程研討或考試');
    $aBody[] = array('flex' => '12', 'body' => $eZui->setCheckBox(array('head' => _('租借理由'), 'name' => 'check', 'value' => ['check'], 'option' => $aOption, "inline" => true,'status'=>'view')));
    $sHtml .= $eZui->setCard(array("body" => $aBody));


    $aBody=array();
        switch ($status) {
        case 'add':
        case 'edit':
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'b13220')));
        break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'b13220')));
        break;
    }
    $sHtml .= $eZui->setGroup(array('body' => $aBody));







    @endphp
    {!! $sHtml !!}
    {!! $eZui->setValidata('main') !!}
</form>
@endsection
