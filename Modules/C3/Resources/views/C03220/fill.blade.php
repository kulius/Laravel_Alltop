@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form method='POST' id='index'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody = array();
    $noteContent = _("有功能無法實現&nbsp已於blade.php內下&nbspTODO");
    $aBody[] = array("flex" => "12", "body" => $eZui->setAlert(array("text" => $noteContent, "style" => "y")));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $sGetParam = null;
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnHref(array("ex" => "save", "text" => "暫存", 'route' => 'c03220', 'param' => array($sGetParam))));
    $sGetParam = null;
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnHref(array("ex" => "leave", "text" => "填完送出", 'route' => 'c03220', 'param' => array($sGetParam))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    // TODO : 題目進度條
    // TODO : 按上/下一頁 切換Radio題目
	$aBody   = array();
    $aOption = array();
    $aOption[] = array('value' => 0, 'text' => '非常不滿意');
    $aOption[] = array('value' => 1, 'text' => '不滿意');
    $aOption[] = array('value' => 2, 'text' => '普通');
    $aOption[] = array('value' => 3, 'text' => '滿意');
    $aOption[] = array('value' => 4, 'text' => '非常滿意');
    $aBody[] = array("flex" => '4', "body" => $eZui->setRadioBox(array("head" => _("3 . 我會回想過去學過的知識，來幫助自己理解或吸收新的知識。"), "inline" => true, "name" => "state", "value" => '1', "option" => $aOption)));
    $sGroup = $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
	$aBody[] = array("flex" => "12", "head" => _("問卷名稱"), "body" => $sGroup);
	$sHtml .= $eZui->setCard(array("body" => $aBody));

    $aBody = array();
    $noteContent = _("備註:<br>
                    &nbsp&nbsp 1.暫存：可依照使用者填寫問狀況做暫時儲存，下次再進填寫時，就會載入使用者填寫暫存記錄。<br>
                    &nbsp&nbsp 2.填完送出：當所有題目填寫完時，此按鈕才會出現。<br>"
                    );
    $aBody[] = array("flex" => "12", "body" => $eZui->setAlert(array("text" => $noteContent, "style" => "y")));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    echo $sHtml;
    @endphp
    {!! $eZui->setValidata('index') !!}
    </form>
@endsection
