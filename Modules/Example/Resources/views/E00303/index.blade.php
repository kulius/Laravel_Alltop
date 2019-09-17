@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form method='POST' id='index'>
    {{ csrf_field() }}
	@php
    $sHtml = null;

    $aBody   = array();
    $aBody[] = array("body" => $eZui->setTextBox(array("head" => _("身分證號"), "name" => "PersonalID_srh", "value" => old("PersonalID_srh"))));

    $sHtml .= $eZui->setGroup(array("body" => $aBody));

    $aBody   = array();
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'search')));
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'e00303_view', 'param' => array('add'))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aField   = array();
    $aField[] = array("head" => _("教師編號"), "name" => "Emp_ID", "width" => "10%", "align" => "center");
    $aField[] = array("head" => _("姓名"), "name" => "ChtName", "width" => "10%");
    $aField[] = array("head" => _("身分證號"), "name" => "PersonalID", "width" => "10%", "align" => "center");
    $aField[] = array("head" => _("通訊地址"), "name" => "MailingAddress", "width" => "20%");
    $aField[] = array("head" => _("聯絡電話"), "name" => "MailingPhone", "width" => "20%");
    $aField[] = array("head" => _("Email"), "name" => "Email", "width" => "20%");
    $aField[] = array("head" => _("銀行代號"), "name" => "BankNo", "width" => "20%");
    $aField[] = array("head" => _("銀行帳戶資料"), "name" => "BankCount", "width" => "20%");
    $aField[] = array("head" => _("備註欄"), "name" => "Memo", "width" => "20%");
    $aField[] = array("head" => _("功能"), "name" => "btn", "align" => "right");

    $aData = array();
    foreach ($data as $skData => $svData) {
        $sEmp_ID            = trim($svData["Emp_ID"]);
        $sChtName        = trim($svData["ChtName"]);
        $sPersonalID     = trim($svData["PersonalID"]);
        $sMailingAddress = trim($svData["MailingAddress"]);
        $sMailingPhone   = trim($svData["MailingPhone"]);
        $sEmail          = trim($svData["Email"]);
        $sBankNo         = trim($svData["BankNo"]);
        $sBankCount      = trim($svData["BankCount"]);
        $sMemo           = trim($svData["Memo"]);

        $aBtn   = array();
        $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "e00303_view", "param" => array("view", $sEmp_ID)));
        $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "e00303_view", "param" => array("edit", $sEmp_ID)));

        //隱藏（KEY）
        $aData[$skData]["Emp_ID"] = $sEmp_ID;

        //顯示
        $aData[$skData]["ChtName"]        = $sChtName;
        $aData[$skData]["PersonalID"]     = $sPersonalID;
        $aData[$skData]["MailingAddress"] = $sMailingAddress;
        $aData[$skData]["MailingPhone"]   = $sMailingPhone;
        $aData[$skData]["Email"]          = $sEmail;
        $aData[$skData]["BankNo"]         = $sBankNo;
        $aData[$skData]["BankCount"]      = $sBankCount;
        $aData[$skData]["Memo"]           = $sMemo;
        $aData[$skData]["btn"]            = implode("", $aBtn);
    }

    $aSet = array(
        "field" => $aField,
        "data"  => $aData,
        // "btn"   => array("remove"),
    );
    $sHtml .= $eZui->setGrid($aSet);

    // ----- 備註 -----
    // $aBody = array();
    // $noteContent = _("備註:<br>
    //                 &nbsp&nbsp 1.備註事項一<br>
    //                 &nbsp&nbsp 2.備註事項二<br>
    //                 &nbsp&nbsp 3.備註事項三<br>"
    //                 );
    // $aBody[] = array("flex" => "12", "body" => $eZui->setAlert(array("text" => $noteContent, "style" => "y")));
    // $sHtml .= $eZui->setGroup(array('body' => $aBody));

    echo $sHtml;
	@endphp
    {!! $eZui->setValidata('index') !!}
    </form>
@endsection
