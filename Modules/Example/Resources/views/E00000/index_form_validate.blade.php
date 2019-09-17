@inject('eZui', 'App\Alltop\BaseView')

<form method='POST' id="index_form_validate" action="{{ route('a011a0_index1_post') }}">
{{ csrf_field() }}
@php
$sHtml = null;

$aBody   = array();
$aBody[] = array("body" => $eZui->setTextBox(array("head" => _("文字方塊"), "name" => "v_text", "value" => "", "req" => true, "min" => 3, "max" => 10)));
$aBody[] = array("body" => $eZui->setNumberBox(array("head" => _("數字方塊"), "name" => "v_number", "value" => "", "req" => true, "min" => 3, "max" => 10)));
$aBody[] = array("body" => $eZui->setMailBox(array("head" => _("郵件方塊"), "name" => "v_mail", "value" => "", "req" => true)));
$aBody[] = array("flex" => "12", "body" => $eZui->setTextArea(array("head" => _("文字區塊"), "name" => "v_textarea", "value" => "", "req" => true)));

$aOption   = array();
$aOption[] = array("value" => "1", "text" => _("選項1"));
$aOption[] = array("value" => "2", "text" => _("選項2"));
$aOption[] = array("value" => "3", "text" => _("選項3"));
$aOption[] = array("value" => "4", "text" => _("選項4"));

$aBody[] = array("flex" => "6", "body" => $eZui->setRadioBox(array("head" => _("單選方塊（預設）"), "name" => "v_radio", "value" => "", "option" => $aOption, "req" => true)));
$aBody[] = array("flex" => "6", "body" => $eZui->setRadioBox(array("head" => _("單選方塊（水平）"), "name" => "v_radio_inline", "value" => "", "option" => $aOption, "inline" => true, "req" => true)));

$aBody[] = array("flex" => "6", "body" => $eZui->setCheckBox(array("head" => _("多選方塊（預設）"), "name" => "v_check", "value" => "", "option" => $aOption, "req" => true, "min" => 2, "max" => 4)));
$aBody[] = array("flex" => "6", "body" => $eZui->setCheckBox(array("head" => _("多選方塊（水平）"), "name" => "v_check_inline", "value" => "", "option" => $aOption, "inline" => true, "req" => true, "min" => 2, "max" => 4)));

$aBody[] = array("flex" => "6", "body" => $eZui->setComboBox(array("head" => _("選項清單-單選（預設）"), "name" => "v_combo", "value" => "", "def" => _("請選擇"), "option" => $aOption, "req" => true)));
$aBody[] = array("flex" => "6", "body" => $eZui->setComboBox(array("head" => _("選項清單-單選（無查詢功能）"), "name" => "v_combo_notsel", "value" => "", "def" => _("請選擇"), "option" => $aOption, "select" => false, "req" => true)));

$aBody[] = array("flex" => "6", "body" => $eZui->setComboBoxMUL(array("head" => _("選項清單-多選（預設）"), "name" => "v_combo_mul", "value" => "", "def" => _("請選擇"), "option" => $aOption, "req" => true)));
$aBody[] = array("flex" => "6", "body" => $eZui->setComboBoxMUL(array("head" => _("選項清單-多選（無查詢功能）"), "name" => "v_combo_mul_notsel", "value" => "", "def" => _("請選擇"), "option" => $aOption, "select" => false, "req" => true)));

$aBody[] = array("flex" => "6", "body" => $eZui->setJumpSel(array("head" => _("選擇視窗-單選"), "name" => "v_jump_sgl", "value" => "", "option" => "", "url" => "e00000_jump_sgl", "req" => true)));
$aBody[] = array("flex" => "6", "body" => $eZui->setJumpSel(array("head" => _("選擇視窗-多選"), "name" => "v_jump_mul", "value" => "", "option" => "", "url" => "e00000_jump_mul", "req" => true)));
$aBody[] = array('body' => $eZui->setJumpSel(array('head' => _('彈跳視窗'), 'name' => 'jump', 'value' => "", 'option' => $aOption, 'url' => '', 'param' => array('head' => '資料選擇'), 'req' => true)));

$sGroup = $eZui->setGroup(array("body" => $aBody));

$aBody     = array();
$aBody[]   = array("flex" => "auto", "body" => $eZui->setBtnSubmit(array("ex" => "save", "value" => "save")));
$sGroupBtn = $eZui->setGroup(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => "12", "head" => "表單元件（進階驗證）<br>" . $eZui->setFont(array("text" => _("※必填、字數限制、數值限制、選項數量限制..."), "style" => "r")), "body" => $sGroupBtn . $sGroup);
$sHtml .= $eZui->setCard(array("body" => $aBody));

echo $sHtml;

@endphp
{!! $eZui->setValidata('index_form_validate') !!}
</form>
