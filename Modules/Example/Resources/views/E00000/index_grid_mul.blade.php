@inject('eZui', 'App\Alltop\BaseView')

<form method='POST' id="index_grid_mul" action="{{ route('a011a0_index1_post') }}">
{{ csrf_field() }}
@php
$sHtml = null;

$aField   = array();
$aField[] = array("head" => _("文字方塊"), "name" => "text", "width" => "15%");
$aField[] = array("head" => _("數字方塊"), "name" => "number", "width" => "10%");
$aField[] = array("head" => _("郵件方塊"), "name" => "mail", "width" => "20%");
$aField[] = array("head" => _("單選方塊"), "name" => "radio", "width" => "30%");
$aField[] = array("head" => _("功能"), "name" => "btn");

$aData = array();
$aModel = array();
$aModel[] = array('seq' => 1, 'text' => '123', 'number' => 123, 'mail' => 'alltop@alltop.com', 'radio' => 1);
$aModel[] = array('seq' => 1, 'text' => '123', 'number' => 123, 'mail' => 'alltop@alltop.com', 'radio' => 1);
foreach ($aModel as $skData => $svData) {
    $sSeq    = trim($svData["seq"]);
    $sText   = trim($svData["text"]);
    $sNumber = trim($svData["number"]);
    $sMail   = trim($svData["mail"]);
    $sRadio  = trim($svData["radio"]);

    $aBtn   = array();
    $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "cmd" => "view", "path" => "main", "param" => array("seq" => $sSeq)));
    $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "cmd" => "edit", "path" => "main", "param" => array("seq" => $sSeq)));

    //隱藏（KEY）
    $aData[$skData]["seq"] = $sSeq;

    //顯示
    $aData[$skData]["text"]   = $sText;
    $aData[$skData]["number"] = $sNumber;
    $aData[$skData]["mail"]   = $sMail;
    $aData[$skData]["radio"]  = $sRadio;
    $aData[$skData]["btn"]    = implode("", $aBtn);
}

$aSet = array(
    "id"    => "mul",
    "field" => $aField,
    "data"  => $aData,
    "btn"   => array("remove", "excel", "pdf", "print", "stop"),
);

$sHtml .= $eZui->setGridMUL($aSet);

echo $sHtml;
@endphp

{!! $eZui->setValidata('index_grid_sgl') !!}
</form>
