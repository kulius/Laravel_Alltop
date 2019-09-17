@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    @include('layouts.error_tips', array('errors' => $errors))

    <form id='main' method='POST' autocomplete='off' enctype="multipart/form-data">
    {{ csrf_field() }}

{{--     <div style="height: 150px; width: 120px;">
    <image img src="/Image/1235.jpg" onerror="this.onerror=null; this.src='/Image/avatar-3.png'" alt="photo" style="max-width: 100%;max-height: 100%";></image>
    </div> --}}
	@php
    $sHTML = null;

    $aBody = array();
    switch ($status) {
        case 'add':
        case 'edit':
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'e00303')));
            break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'e00303')));
            break;
    }

    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    $aGroup = array();
    $aBody = array();
    $aBody[] = array("flex" => 4, "body" => $eZui->setTextBox(array("head" => _("教師編號"), "name" => "Emp_ID", "value" => old("Emp_ID") ?? $data["Emp_ID"], 'req' => true)));
    $aBody[] = array("flex" => 4, "body" => $eZui->setTextBox(array("head" => _("中文姓名"), "name" => "ChtName", "value" => old("ChtName") ?? $data["ChtName"])));
    $aBody[] = array("flex" => 4, "body" => $eZui->setTextBox(array("head" => _("身分證號"), "name" => "PersonalID", "value" => old("PersonalID") ?? $data["PersonalID"])));
    $aBody[] = array("flex" => 4, "body" => $eZui->setTextBox(array("head" => _("英文姓名 First Name"), "name" => "FirstName", "value" => old("FirstName") ?? $data["FirstName"])));
    $aBody[] = array("flex" => 4, "body" => $eZui->setTextBox(array("head" => _("Middle Name"), "name" => "MiddleName", "value" => old("MiddleName") ?? $data["MiddleName"])));
    $aBody[] = array("flex" => 4, "body" => $eZui->setTextBox(array("head" => _("Last Name"), "name" => "LastName", "value" => old("LastName") ?? $data["LastName"])));
    $aBody[] = array("flex" => 12, "body" => $eZui->setTextBox(array("head" => _("戶籍地址"), "name" => "ResidenceAddress", "value" => old("ResidenceAddress") ?? $data["ResidenceAddress"])));
    $aBody[] = array("flex" => 12, "body" => $eZui->setTextBox(array("head" => _("通訊地址"), "name" => "MailingAddress", "value" => old("MailingAddress") ?? $data["MailingAddress"])));
    $aGroup[] = array("flex" => 9, "body" => $eZui->setGroup(array('body' => $aBody)));

    $aBody = array();

    $showImage = "
    <div style='height: 200px; width: 180px; margin:auto;''>
    <image img id='photo' src='/Image/{$data["Emp_ID"]}.jpg' onerror=\"this.onerror=null; this.src='/Image/avatar-3.png'\" alt='photo' style='max-width: 100%;max-height: 100%';></image>
    </div>
    ";

    // $aBody[] = array("flex" => 12, "body" => $showImage);
    $aBody[] = array("flex" => 12,"head" => _("個人照片上傳"), "body" =>  $showImage . $eZui->setFileBox(array( "name" => "Photo", "value"=>old('Photo[]'))));
    $aGroup[] = array("flex" => 3, "body" => $eZui->setGroup(array('body' => $aBody)));

    $sHTML .= $eZui->setGroup(array('body' => $aGroup));

    $aBody = array();

    $aBody[] = array("flex" => 6, "body" => $eZui->setTextBox(array("head" => _("連絡電話"), "name" => "MailingPhone", "value" => old("MailingPhone") ?? $data["MailingPhone"])));
    $aBody[] = array("flex" => 6, "body" => $eZui->setTextBox(array("head" => _("Email"), "name" => "Email", "value" => old("Email") ?? $data["Email"])));
    $aBody[] = array("flex" => 4, "body" => $eZui->setTextBox(array("head" => _("銀行代碼"), "name" => "BankNo", "value" => old("BankNo") ?? $data["BankNo"])));
    $aBody[] = array("flex" => 8, "body" => $eZui->setTextBox(array("head" => _("銀行帳號"), "name" => "BankCount", "value" => old("BankCount") ?? $data["BankCount"])));

    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    $aMemo   = array();
    $aMemo[] = $eZui->setFont(array("text" => _("備註："), "style" => "r"));
    $aMemo[] = _("");
    $sHTML .= $eZui->setAlert(array("text" => $aMemo, "style" => "y"));

	@endphp
    {!! $sHTML !!}
    {!! $eZui->setValidata('main') !!}
    </form>
@endsection
