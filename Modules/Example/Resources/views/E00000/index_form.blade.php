@inject('eZui', 'App\Alltop\BaseView')

<form method='POST' id="index_form" action="{{ route('a011a0_index1_post') }}">
{{ csrf_field() }}
@php
$sHtml = null;

$aBody   = array();
$aBody[] = array("body" => $eZui->setTextBox(array("head" => _("文字方塊"), "name" => "text", "value" => "")));
$aBody[] = array("body" => $eZui->setNumberBox(array("head" => _("數字方塊"), "name" => "number", "value" => "")));
$aBody[] = array("body" => $eZui->setMailBox(array("head" => _("郵件方塊"), "name" => "mail", "value" => "")));
$aBody[] = array("body" => $eZui->setDateBox(array("head" => _("日期方塊"), "name" => "date", "value" => "")));
//$aBody[] = array("body" => $eZui->setDateBoxMUL(array("head" => _("日期方塊（複選）"), "name" => "date_mul", "value" => "")));
$aBody[] = array("body" => $eZui->setTimeBox(array("head" => _("時間方塊"), "name" => "time", "value" => "")));
$aBody[] = array("body" => $eZui->setDateTimeBox(array("head" => _("日期/時間方塊"), "name" => "datetime", "value" => "")));
$aBody[] = array("flex" => "12", "body" => $eZui->setTextArea(array("head" => _("文字區塊"), "name" => "textarea", "value" => "")));
$aBody[] = array("flex" => "12", "body" => $eZui->setEditArea(array("head" => _("文字編輯器"), "name" => "editarea", "value" => "")));

$aOption   = array();
$aOption[] = array("value" => "1", "text" => _("選項1"));
$aOption[] = array("value" => "2", "text" => _("選項2"));
$aOption[] = array("value" => "3", "text" => _("選項3"));
$aOption[] = array("value" => "4", "text" => _("選項4"));

$aBody[] = array("flex" => "6", "body" => $eZui->setRadioBox(array("head" => _("單選方塊（預設）"), "name" => "radio", "value" => "", "option" => $aOption)));
$aBody[] = array("flex" => "6", "body" => $eZui->setRadioBox(array("head" => _("單選方塊（水平）"), "name" => "radio_inline", "value" => "", "option" => $aOption, "inline" => true)));

$aBody[] = array("flex" => "6", "body" => $eZui->setCheckBox(array("head" => _("多選方塊（預設）"), "name" => "check", "value" => "", "option" => $aOption)));
$aBody[] = array("flex" => "6", "body" => $eZui->setCheckBox(array("head" => _("多選方塊（水平）"), "name" => "check_inline", "value" => "", "option" => $aOption, "inline" => true)));

$aBody[] = array("flex" => "6", "body" => $eZui->setComboBox(array("head" => _("選項清單-單選（預設）"), "name" => "combo", "value" => "", "def" => _("請選擇"), "option" => $aOption)));
$aBody[] = array("flex" => "6", "body" => $eZui->setComboBox(array("head" => _("選項清單-單選（無查詢功能）"), "name" => "combo_notsel", "value" => "", "def" => _("請選擇"), "option" => $aOption, "select" => false)));

$aBody[] = array("flex" => "6", "body" => $eZui->setComboBoxMUL(array("head" => _("選項清單-多選（預設）"), "name" => "combo_mul", "value" => "", "def" => _("請選擇"), "option" => $aOption)));
$aBody[] = array("flex" => "6", "body" => $eZui->setComboBoxMUL(array("head" => _("選項清單-多選（無查詢功能）"), "name" => "combo_mul_notsel", "value" => "", "def" => _("請選擇"), "option" => $aOption, "select" => false)));

$aBody[] = array("flex" => "6", "body" => $eZui->setJumpSel(array("head" => _("選擇視窗-單選"), "name" => "jump_sgl", "value" => "", "option" => "", "url" => "e00000_jump_sgl")));
$aBody[] = array("flex" => "6", "body" => $eZui->setJumpSel(array("head" => _("選擇視窗-多選"), "name" => "jump_mul", "value" => "", "option" => "", "url" => "e00000_jump_mul")));
$aBody[] = array("flex" => "6", "body" => $eZui->setJumpSel(array("head" => _("選擇視窗（父視窗刷新）"), "name" => "jump_1", "value" => "", "option" => "", "url" => "e00000_jump_sgl", "reload" => false)));
$aBody[] = array("flex" => "6", "body" => $eZui->setJumpSel(array("head" => _("選擇視窗（子視窗不關閉）"), "name" => "jump_2", "value" => "", "option" => "", "url" => "e00000_jump_mul", "close" => false)));

$sGroup = $eZui->setGroup(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => "12", "head" => "表單元件<br>" . $eZui->setFont(array("text" => _("※部分欄位內建，基本格式驗證"), "style" => "r")), "body" => $sGroup);
$sHtml .= $eZui->setCard(array("body" => $aBody));

echo $sHtml;

@endphp

{!! $eZui->setValidata('index_form') !!}
</form>
