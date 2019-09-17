@inject('eZui', 'App\Alltop\BaseView')

<form method='POST' id="index_other" action="{{ route('a011a0_index1_post') }}">
{{ csrf_field() }}
@php
$sHtml = null;

$aField   = array();
$aField[] = array("head" => _("欄位1"), "width" => "10%");
$aField[] = array("head" => _("欄位2"));
$aField[] = array("head" => _("欄位3"), "width" => "20%");
$aField[] = array("head" => _("欄位4"), "width" => "15%");

$aData = array();

$aData[0][] = "純文字";
$aData[0][] = $eZui->setTextBox(array("name" => "tb_text", "value" => ""));
$aData[0][] = $eZui->setNumberBox(array("name" => "tb_number", "value" => ""));
$aData[0][] = $eZui->setMailBox(array("name" => "tb_mail", "value" => ""));

$aSet = array(
    "field" => $aField,
    "data"  => $aData,
);

$aTable = $eZui->setTable($aSet);

$aBody   = array();
$aBody[] = array("flex" => "12", "head" => _("Table"), "body" => $aTable);
$sHtml .= $eZui->setCard(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => "4", "body" => $eZui->setAlert(array("text" => _("Alert"), "style" => "b")));
$aBody[] = array("flex" => "4", "body" => $eZui->setAlert(array("text" => _("Alert"), "style" => "g")));
$aBody[] = array("flex" => "4", "body" => $eZui->setAlert(array("text" => _("Alert"), "style" => "d")));
$aBody[] = array("flex" => "4", "body" => $eZui->setAlert(array("text" => _("Alert"), "style" => "r")));
$aBody[] = array("flex" => "4", "body" => $eZui->setAlert(array("text" => _("Alert"), "style" => "y")));
$aBody[] = array("flex" => "4", "body" => $eZui->setAlert(array("text" => _("Alert"), "style" => "i")));
$aBody[] = array("flex" => "4", "body" => $eZui->setAlert(array("text" => _("Alert"), "style" => "d")));
$sGroup  = $eZui->setGroup(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => "12", "head" => _("Alert"), "body" => $sGroup);
$sHtml .= $eZui->setCard(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => "2", "body" => $eZui->setFont(array("text" => _("Font"), "style" => "b")));
$aBody[] = array("flex" => "2", "body" => $eZui->setFont(array("text" => _("Font"), "style" => "g")));
$aBody[] = array("flex" => "2", "body" => $eZui->setFont(array("text" => _("Font"), "style" => "d")));
$aBody[] = array("flex" => "2", "body" => $eZui->setFont(array("text" => _("Font"), "style" => "r")));
$aBody[] = array("flex" => "2", "body" => $eZui->setFont(array("text" => _("Font"), "style" => "y")));
$aBody[] = array("flex" => "2", "body" => $eZui->setFont(array("text" => _("Font"), "style" => "i")));
$aBody[] = array("flex" => "2", "body" => $eZui->setFont(array("text" => _("Font"), "style" => "d")));
$sGroup  = $eZui->setGroup(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => "12", "head" => _("Font Style"), "body" => $sGroup);
$sHtml .= $eZui->setCard(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("head" => _("預設"), "flex" => "2", "body" => $eZui->setFont(array("text" => _("Font"))));
$aBody[] = array("head" => _("放大"), "flex" => "2", "body" => $eZui->setFont(array("text" => _("Font"), "size" => "1.7")));
$aBody[] = array("head" => _("縮小"), "flex" => "2", "body" => $eZui->setFont(array("text" => _("Font"), "size" => "0.5")));
$sGroup  = $eZui->setGroup(array("body" => $aBody));

$aBody   = array();
$aBody[] = array("flex" => "12", "head" => _("Font Size"), "body" => $sGroup);
$sHtml .= $eZui->setCard(array("body" => $aBody));


echo $sHtml;

@endphp
{!! $eZui->setValidata('index_other') !!}
</form>
