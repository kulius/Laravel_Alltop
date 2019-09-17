@inject('eZui', 'App\Alltop\BaseView')

<form method='POST' id="index_button" action="{{ route('a011a0_index1_post') }}">
{{ csrf_field() }}
@php
$sHtml = null;

/**
 * 表單規劃
 * ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
 */
$aBody   = array();
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("icon" => "fas fa-crown", "icon_style" => "b", "style" => "do")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("icon" => "fas fa-crown", "icon_style" => "g", "style" => "do")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("icon" => "fas fa-crown", "icon_style" => "r", "style" => "do")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("icon" => "fas fa-crown", "icon_style" => "y", "style" => "do")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("icon" => "fas fa-crown", "icon_style" => "i", "style" => "do")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("icon" => "fas fa-crown", "icon_style" => "d", "style" => "do")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("icon" => "fas fa-crown", "icon_style" => "s", "style" => "do")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("icon" => "fas fa-crown", "icon_style" => "l", "style" => "do")));
$sGroup  = $eZui->setGroup(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => "12", "head" => "ICon Style", "body" => $sGroup);
$sHtml .= $eZui->setCard(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("text" => _("Button"), "style" => "b")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("text" => _("Button"), "style" => "g")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("text" => _("Button"), "style" => "r")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("text" => _("Button"), "style" => "y")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("text" => _("Button"), "style" => "i")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("text" => _("Button"), "style" => "d")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("text" => _("Button"), "style" => "s")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("text" => _("Button"), "style" => "l")));
$sGroup1 = $eZui->setGroup(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("text" => _("Button"), "style" => "bo")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("text" => _("Button"), "style" => "go")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("text" => _("Button"), "style" => "ro")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("text" => _("Button"), "style" => "yo")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("text" => _("Button"), "style" => "io")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("text" => _("Button"), "style" => "do")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("text" => _("Button"), "style" => "so")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("text" => _("Button"), "style" => "lo")));
$sGroup2 = $eZui->setGroup(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => "6", "head" => _("Button Style（基本）"), "body" => $sGroup1);
$aBody[] = array("flex" => "6", "head" => _("Button Style（線）"), "body" => $sGroup2);
$sHtml .= $eZui->setCard(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("ex" => "add")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("ex" => "remove")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("ex" => "edit")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("ex" => "view")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("ex" => "search")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("ex" => "save")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("ex" => "cancel")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("ex" => "leave")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("ex" => "users")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("ex" => "click")));
$sGroup1 = $eZui->setGroup(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("ex" => "add", "small" => true)));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("ex" => "remove", "small" => true)));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("ex" => "edit", "small" => true)));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("ex" => "view", "small" => true)));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("ex" => "search", "small" => true)));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("ex" => "save", "small" => true)));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("ex" => "cancel", "small" => true)));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("ex" => "leave", "small" => true)));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("ex" => "users", "small" => true)));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("ex" => "click", "small" => true)));
$sGroup2 = $eZui->setGroup(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => "6", "head" => _("ICon Button（內建）"), "body" => $sGroup1);
$aBody[] = array("flex" => "6", "head" => _("Only ICon Button（內建）"), "body" => $sGroup2);
$sHtml .= $eZui->setCard(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("text" => _("Button"), "icon" => "fas fa-crown", "style" => "b")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("text" => _("Button"), "icon" => "fas fa-crown", "style" => "g")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("text" => _("Button"), "icon" => "fas fa-crown", "style" => "r")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("text" => _("Button"), "icon" => "fas fa-crown", "style" => "y")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("text" => _("Button"), "icon" => "fas fa-crown", "style" => "i")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("text" => _("Button"), "icon" => "fas fa-crown", "style" => "d")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("text" => _("Button"), "icon" => "fas fa-crown", "style" => "s")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("text" => _("Button"), "icon" => "fas fa-crown", "style" => "l")));
$sGroup1 = $eZui->setGroup(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("icon" => "fas fa-crown", "style" => "b")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("icon" => "fas fa-crown", "style" => "g")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("icon" => "fas fa-crown", "style" => "r")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("icon" => "fas fa-crown", "style" => "y")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("icon" => "fas fa-crown", "style" => "i")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("icon" => "fas fa-crown", "style" => "d")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("icon" => "fas fa-crown", "style" => "s")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setBtn(array("icon" => "fas fa-crown", "style" => "l")));
$sGroup2 = $eZui->setGroup(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => "6", "head" => _("ICon Button（自定義）"), "body" => $sGroup1);
$aBody[] = array("flex" => "6", "head" => _("Only ICon Button（自定義）"), "body" => $sGroup2);
$sHtml .= $eZui->setCard(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("head" => _("Submit"), "body" => $eZui->setBtnSubmit(array("ex" => "add", "value" => "Button值（POST名稱：act）")));
$aBody[] = array("head" => _("Href"), "body" => $eZui->setBtnHref(array("ex" => "edit", "cmd" => "Button值（GET參數名稱：cmd）", "path" => "同專案", "url" => "跨專案", "param" => array("key" => "value"))));
$aBody[] = array("head" => _("Button（自定義）"), "body" => $eZui->setBtn(array("text" => _("Button"), "icon" => "fas fa-crown", "attr" => array("onclick=BtnAdd();"))));
$sGroup  = $eZui->setGroup(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => "12", "head" => _("按鈕使用範例"), "body" => $sGroup);
$sHtml .= $eZui->setCard(array("body" => $aBody));


//$sHtml .= $eZui->setForm(array("name" => "button", "body" => $aForm));

echo $sHtml;
@endphp

{!! $eZui->setValidata('index_button') !!}
</form>