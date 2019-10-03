@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.frame_modal', array('Load' => false))

@section('content')
    <form method='POST' id='index'>
    {{ csrf_field() }}
    <?php
$sHtml = null;

$aBody   = array();
$aBody[] = array("flex" => "4", "body" => $eZui->setComboBox(array("head" => _("學年"), "name" => "srh[ACADYear]", "value" => $sYear, "option" => $YearOp, "attr" => array("onchange='form.submit()'"))));
$aBody[] = array("flex" => "4", "body" => $eZui->setComboBox(array("head" => _("學期"), "name" => "srh[Semester]", "value" => $sSemester, "option" => $SemesterOp, "attr" => array("onchange='form.submit()'"))));
$aBody[] = array("flex" => "4", "body" => $eZui->setComboBox(array("head" => _("部別"), "name" => "srh[DayfgID]", "value" => $sDayfgID, "option" => $DayfgOp, "attr" => array("onchange='form.submit()'"))));
$aBody[] = array("flex" => "4", "body" => $eZui->setComboBox(array("head" => _("學制"), "name" => "srh[ClassTypeID]", "value" => $sClassTypeID, "option" => $ClassTypeOp, "attr" => array("onchange='form.submit()'"))));
$aBody[] = array("flex" => "4", "body" => $eZui->setComboBox(array("head" => _("學院"), "name" => "srh[CollegeID]", "value" => $sCollegeID, "option" => $CollegeOp, "attr" => array("onchange='form.submit()'"))));
$aBody[] = array("flex" => "4", "body" => $eZui->setComboBox(array("head" => _("系所"), "name" => "srh[UnitID]", "value" => $sUnitID, "option" => $UnitOp, "attr" => array("onchange='form.submit()'"))));
$aBody[] = array("flex" => "4", "body" => $eZui->setComboBox(array("head" => _("組別"), "name" => "srh[StudyGroupID]", "value" => $sStudyGroupID, "option" => $StudyGroupOp, "attr" => array("onchange='form.submit()'"))));
$aBody[] = array("flex" => "4", "body" => $eZui->setComboBox(array("head" => _("年級"), "name" => "srh[Grade]", "value" => $sGrade, "option" => $GradeOp, "attr" => array("onchange='form.submit()'"))));
$aBody[] = array("flex" => "4", "body" => $eZui->setComboBox(array("head" => _("班級"), "name" => "srh[ClassID]", "value" => $sClassID, "option" => $ClassOp)));

$aBody[] = array('flex' => '4', 'body' => $eZui->setTextBox(array('head' => _('學號'), 'name' => 'text1', 'value' => old('text1'))));
$aBody[] = array('flex' => '4', 'body' => $eZui->setTextBox(array('head' => _('姓名'), 'name' => 'text2', 'value' => old('text2'))));
$sHtml .= $eZui->setGroup(array('body' => $aBody));

$aBody   = array();
$aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnClass(array('ex' => 'excel', 'value' => 'excel')));
$aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'import', 'text' => '匯出原始資料')));
$sHtml .= $eZui->setGroup(array('body' => $aBody));

echo $sHtml;
?>
    {!! $eZui->setValidata('index') !!}
    </form>
@endsection
