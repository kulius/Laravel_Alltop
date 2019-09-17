@inject('eZui', 'App\Alltop\BaseView')

<form method='POST' id="index_layout" action="{{ route('a011a0_index1_post') }}">
{{ csrf_field() }}
@php
$sHtml = null;

$sHtml .= $eZui->setAlert(array("text" => _("※響應式網頁，會依據目前網頁寬度，分成「12」欄等寬的網格，工程師可自行配置。")));

$aBody   = array();
$aBody[] = array("body" => $eZui->setTextBox(array("head" => _("文字方塊"), "name" => "lyt_1", "value" => "")));
$aBody[] = array("body" => $eZui->setTextBox(array("head" => _("文字方塊"), "name" => "lyt_2", "value" => "")));
$aBody[] = array("body" => $eZui->setTextBox(array("head" => _("文字方塊"), "name" => "lyt_3", "value" => "")));
$sGroup  = $eZui->setGroup(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => 12, "head" => _("預設佈局（４/１２）"), "body" => $sGroup);
$sHtml .= $eZui->setCard(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => 2, "body" => $eZui->setTextBox(array("head" => _("文字方塊"), "name" => "h_lyt_1_1", "value" => "")));
$aBody[] = array("flex" => 2, "body" => $eZui->setTextBox(array("head" => _("文字方塊"), "name" => "h_lyt_1_2", "value" => "")));
$aBody[] = array("flex" => 2, "body" => $eZui->setTextBox(array("head" => _("文字方塊"), "name" => "h_lyt_1_3", "value" => "")));
$aBody[] = array("flex" => 2, "body" => $eZui->setTextBox(array("head" => _("文字方塊"), "name" => "h_lyt_1_4", "value" => "")));
$aBody[] = array("flex" => 2, "body" => $eZui->setTextBox(array("head" => _("文字方塊"), "name" => "h_lyt_1_5", "value" => "")));
$aBody[] = array("flex" => 2, "body" => $eZui->setTextBox(array("head" => _("文字方塊"), "name" => "h_lyt_1_6", "value" => "")));
$sGroup  = $eZui->setGroup(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => "12", "head" => _("進階佈局（２/１２）"), "body" => $sGroup);
$sHtml .= $eZui->setCard(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => 3, "body" => $eZui->setTextBox(array("head" => _("文字方塊"), "name" => "h_lyt_2_1", "value" => "")));
$aBody[] = array("flex" => 3, "body" => $eZui->setTextBox(array("head" => _("文字方塊"), "name" => "h_lyt_2_2", "value" => "")));
$aBody[] = array("flex" => 3, "body" => $eZui->setTextBox(array("head" => _("文字方塊"), "name" => "h_lyt_2_3", "value" => "")));
$aBody[] = array("flex" => 3, "body" => $eZui->setTextBox(array("head" => _("文字方塊"), "name" => "h_lyt_2_4", "value" => "")));
$sGroup  = $eZui->setGroup(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => "12", "head" => _("進階佈局（３/１２）"), "body" => $sGroup);
$sHtml .= $eZui->setCard(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => 6, "body" => $eZui->setTextBox(array("head" => _("文字方塊"), "name" => "h_lyt_3_2", "value" => "")));
$aBody[] = array("flex" => 6, "body" => $eZui->setTextBox(array("head" => _("文字方塊"), "name" => "h_lyt_3_1", "value" => "")));
$sGroup  = $eZui->setGroup(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => 12, "head" => _("進階佈局（６/１２）"), "body" => $sGroup);
$sHtml .= $eZui->setCard(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => 12, "body" => $eZui->setTextBox(array("head" => _("文字方塊"), "name" => "h_lyt_4", "value" => "")));
$sGroup  = $eZui->setGroup(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => 12, "head" => _("進階佈局（１２/１２）"), "body" => $sGroup);
$sHtml .= $eZui->setCard(array("body" => $aBody));

$aOption   = array();
$aOption[] = array("value" => "1", "text" => _("選項1"));
$aOption[] = array("value" => "2", "text" => _("選項2"));
$aOption[] = array("value" => "3", "text" => _("選項3"));
$aOption[] = array("value" => "4", "text" => _("選項4"));

$aBody   = array();
$aBody[] = array("flex" => 6, "body" =>
    $eZui->setComboBox(array("name" => "form[0][drop]", "value" => '空值', "option" => $aOption, "req" => true, "def" => _("請選擇"))),
);
$aBody[] = array("flex" => 6, "body" =>
    $eZui->setComboBox(array("name" => "form[0][drop]", "value" => '空值', "option" => $aOption, "req" => true, "def" => _("請選擇"))),
);
$sGroup = $eZui->setGroup(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("head" => _("下拉選單"), "body" => $sGroup);
$sGroup  = $eZui->setGroup(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => 12, "head" => _("創意佈局"), "body" => $sGroup);
$sHtml .= $eZui->setCard(array("body" => $aBody));


echo $sHtml;

@endphp
{!! $eZui->setValidata('index_layout') !!}
</form>
