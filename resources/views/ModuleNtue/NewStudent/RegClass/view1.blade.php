@inject('eZui', 'App\Alltop\BaseView')

<form method='POST' id="view1" action="{{ route('a011a0_view1_post') }}">
{{ csrf_field() }}
@php
$sHtml = null;

$aOption   = array();
$aOption[] = array('key' => '1', 'value' => _('選項1'));
$aOption[] = array('key' => '2', 'value' => _('選項2'));
$aOption[] = array('key' => '3', 'value' => _('選項3'));
$aOption[] = array('key' => '4', 'value' => _('選項4'));

$aBody   = array();
$aBody[] = array("flex" => "3", "body" => $eZui->setComboBox(array("head" => _("部別"), "name" => "Dayfg_srh", "value" => old("Dayfg_srh"), "option" => $aDayfg, "select" => false, "def" => _("請選擇"), "attr" => array("onchange='form.submit()'"))));
$aBody[] = array("flex" => "3", "body" => $eZui->setComboBox(array("head" => _("學制"), "name" => "ClassType_srh", "value" => old("ClassType_srh"), "option" => $aYearCombo, "select" => false, "def" => _("請選擇"), "attr" => array("onchange='form.submit()'"))));
$aBody[] = array("flex" => "3", "body" => $eZui->setComboBox(array("head" => _("學院"), "name" => "College_srh", "value" => old("College_srh"), "option" => $aYearCombo, "select" => false, "def" => _("請選擇"), "attr" => array("onchange='form.submit()'"))));
$aBody[] = array("flex" => "3", "body" => $eZui->setComboBox(array("head" => _("系所"), "name" => "Unit_srh", "value" => old("Unit_srh"), "option" => $aYearCombo, "select" => false, "def" => _("請選擇"), "attr" => array("onchange='form.submit()'"))));
$aBody[] = array("flex" => "6", "body" => $eZui->setComboBox(array("head" => _("學程"), "name" => "UnitClassType_srh", "value" => old("UnitClassType_srh"), "option" => $aUnitClassType, "select" => false, "def" => _("請選擇"), "attr" => array("onchange='form.submit()'"))));
$sHtml .= $eZui->setGroup(array('body' => $aBody));

$aBody   = array();
$aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'search')));
$aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'e00100_view', 'param' => array('add'))));
$sHtml .= $eZui->setGroup(array('body' => $aBody));

$aField   = array();
$aField[] = array("head" => _("部別"), "name" => "DayfgName", "width" => "15%");
$aField[] = array("head" => _("學制"), "name" => "ClassTypeName", "width" => "20%");
$aField[] = array("head" => _("學院"), "name" => "CollegeName", "width" => "20%");
$aField[] = array("head" => _("系所"), "name" => "UnitName", "width" => "20%");
$aField[] = array("head" => _("學程"), "name" => "UnitClassTypeName", "width" => "20%");
$aField[] = array("head" => _("班級代碼"), "name" => "ClassNo", "width" => "20%");
$aField[] = array("head" => _("功能"), "name" => "btn", "align" => "right");

$aView1_Data = isset($aView1_Data) ? $aView1_Data : array();
$aData = array();
foreach ($aView1_Data as $key => $value) {
    $sClassID           = trim($value["ClassID"]);
    $sDayfgID           = trim($value["DayfgID"]);
    $sClassTypeID       = trim($value["ClassTypeID"]);
    $sStudyGroupID      = trim($value["StudyGroupID"]);
    $sUnitID            = trim($value["UnitID"]);
    $sDayfgName         = trim($value["DayfgName"]);
    $sClassTypeName     = trim($value["ClassTypeName"]);
    $sCollegeName       = trim($value["CollegeName"]);
    $sUnitName          = trim($value["UnitName"]);
    $sUnitClassTypeName = trim($value["UnitClassTypeName"]);
    $sClassNo           = trim($value["ClassNo"]);

    $aBtn   = array();
    $aBtn[] = $eZui->setBtnHref(array('ex' => 'edit', 'small' => true, 'route' => 'e00100_view', 'param' => array('edit', $sSeq)));
    $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "a0010a", "param" => array("DayfgID" => $sDayfgID, "ClassTypeID" => $sClassTypeID, "UnitID" => $sUnitID, "StudyGroupID" => $sStudyGroupID, "ClassNo" => $sClassNo)));

    //隱藏（KEY）
    $aData[$key]["ClassID"] = $sClassID;

    //顯示
    $aData[$key]["DayfgName"]         = $sDayfgName;
    $aData[$key]["ClassTypeName"]     = $sClassTypeName;
    $aData[$key]["CollegeName"]       = $sCollegeName;
    $aData[$key]["UnitName"]          = $sUnitName;
    $aData[$key]["UnitClassTypeName"] = $sUnitClassTypeName;
    $aData[$key]["ClassNo"]           = $sClassNo;
    $aData[$key]["btn"]               = implode("", $aBtn);
}

$aSet = array(
    'id' => 'classRoom',
    'field' => $aField,
    'data'  => $aData,
    'btn'   => array('remove', 'excel', 'pdf', 'print'),
);

$sHtml .= $eZui->setGridMUL($aSet);

echo $sHtml;

@endphp
{!! $eZui->setValidata('view1') !!}
</form>

