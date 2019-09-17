@inject('eZui', 'App\Alltop\BaseView')

<form method='POST' id="index2" action="{{ route('a011a0_index2_post') }}">
{{ csrf_field() }}
@php
$sHtml = null;


$aBody   = array();
$aBody[] = array("body" => $eZui->setComboBox(array("head" => _("學年"), "name" => "ACADYear_srh", "value" => $aYear[5], "option" => $aYear, "select" => false)));
$aBody[] = array("body" => $eZui->setComboBox(array("head" => _("學期"), "name" => "Semester_srh", "value" => $aYear[5], "option" => $aSemester, "select" => false)));
$aBody[] = array("flex" => "2", "body" => $eZui->setComboBox(array("head" => _("學程"), "name" => "SemUnitClassType_srh", "value" => old("SemUnitClassType_srh"), "option" => $aSemUnitClassType, "select" => false, "def" => _("請選擇"), "attr" => array("onchange='form.submit()'"))));
$sHtml .= $eZui->setGroup(array('body' => $aBody));

$aBody   = array();
$aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'search')));
$aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'e00100_view', 'param' => array('add'))));
$sHtml .= $eZui->setGroup(array('body' => $aBody));

$aField   = array();
$aField[] = array("head" => _("學年"), "name" => "ACADYear", "width" => "6%", "align" => "center");
$aField[] = array("head" => _("學期"), "name" => "Semester", "width" => "6%", "align" => "center");
$aField[] = array("head" => _("原班級名稱"), "name" => "ClassID", "width" => "15%");
$aField[] = array("head" => _("學程"), "name" => "UnitClassTypeID", "width" => "17%");

$aField[] = array("head" => _("年度班級名稱"), "name" => "ClassName");
$aField[] = array("head" => _("年度班級英文名稱"), "name" => "ClassENGName");
$aField[] = array("head" => _("年度班級簡稱"), "name" => "ClassAlias");

$aEField = array();

$aEField[] = array("head" => _("學年"), "name" => "ACADYear", "type" => "combo", "option" => $aYear);
$aEField[] = array("head" => _("學期"), "name" => "Semester", "type" => "combo", "option" => $aSemester);
$aEField[] = array("head" => _("原班級名稱"), "name" => "ClassID", "type" => "combo", "option" => $aClass);
$aEField[] = array("head" => _("學程"), "name" => "UnitClassTypeID", "type" => "combo", "option" => $aUnitClassType);

$aEField[] = array("head" => _("年度班級名稱"), "name" => "ClassName");
$aEField[] = array("head" => _("年度班級英文名稱"), "name" => "ClassENGName");
$aEField[] = array("head" => _("年度班級簡稱"), "name" => "ClassAlias");

$aData_ClassYear = isset($aData_ClassYear) ? $aData_ClassYear : array();
$aData = array();
foreach ($aData_ClassYear as $skData => $svData) {
    $sACADYear        = trim($svData["ACADYear"]);
    $sSemester        = trim($svData["Semester"]);
    $sClassID         = trim($svData["ClassID"]);
    $sUnitClassTypeID = trim($svData["UnitClassTypeID"]);
    $sClassName       = trim($svData["ClassName"]);
    $sClassENGName    = trim($svData["ClassENGName"]);
    $sClassAlias      = trim($svData["ClassAlias"]);

    //隱藏（KEY）
    $aData[$skData]["ACADYear"] = $sACADYear;

    //顯示
    $aData[$skData]["Semester"]        = $sSemester;
    $aData[$skData]["ClassID"]         = $sClassID;
    $aData[$skData]["UnitClassTypeID"] = $sUnitClassTypeID;
    $aData[$skData]["ClassName"]       = $sClassName;
    $aData[$skData]["ClassENGName"]    = $sClassENGName;
    $aData[$skData]["ClassAlias"]      = $sClassAlias;
}

$aSet = array(
    'id' => 'semesterClassRoom',
    "field"  => $aField,
    "efield" => $aEField,
    "data"   => $aData,
    "btn"    => array("remove", "add", "save"),
);

$sHtml .= $eZui->setEGrid($aSet);

echo $sHtml;
@endphp
{!! $eZui->setValidata('index2') !!}
</form>
