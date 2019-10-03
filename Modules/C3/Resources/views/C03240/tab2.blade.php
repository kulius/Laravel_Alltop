@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form method='POST' id='index'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $sTabHtml = null;
    $aBody   = array();
   $aBody[] = array("flex" => '4', "body" => $eZui->setComboBox(array("head" => __("學年"), "name" => "srh[ACADYear]",
     "value" => $sYear, "option" => $aYearOp, "select" => false,"def" => _("請選擇") , 'attr' => array("onchange=form.submit()")  )));
    $aBody[] = array("flex" => '4', "body" => $eZui->setComboBox(array("head" => __("學期"), "name" => "srh[Semester]",
     "value" => $sSem, "option" => $aSemOp,"select" => false,"def" => _("請選擇") , 'attr' => array("onchange=form.submit()") )));
    $aBody[] = array("flex" => '4', "body" => $eZui->setComboBox(array("head" => __("部別"), "name" => "srh[DayfgID]",
     "value" => $sDayfgID, "option" => $aDfgOp,"select" => false,"def" => _("請選擇") , 'attr' => array("onchange=form.submit()") )));
    $aBody[] = array("flex" => '4', "body" => $eZui->setComboBox(array("head" => __("學制"), "name" => "srh[ClassTypeID]",
     "value" => $sClassTypeID,"option" => $aClassTypeOp, "select" => false, "def" => _("請選擇") , 'attr' => array("onchange=form.submit()") )));
    $aBody[] = array("flex" => '4', "body" => $eZui->setComboBox(array("head" => __("學院"), "name" => "srh[CollegeID]",
     "value" => $sCollegeID, "option" => $aCollegeOp, "select" => false,"def" => _("請選擇") , 'attr' => array("onchange=form.submit()") )));
    $aBody[] = array("flex" => '4', "body" => $eZui->setComboBox(array("head" => __("系所"), "name" => "srh[UnitID]",
     "value" => $sUnitID, "option" => $aUnitOp,"select" => false,"def" => _("請選擇") , 'attr' => array("onchange=form.submit()") )));
    $aBody[] = array("flex" => '4', "body" => $eZui->setComboBox(array("head" => __("系組別"), "name" => "srh[UnitID]",
     "value" => $sStudyGroupID, "option" => $aStudyGroupOp,"select" => false,"def" => _("請選擇") , 'attr' => array("onchange=form.submit()") )));
     $aBody[] = array("flex" => '4', "body" => $eZui->setComboBox(array("head" => __("年級"), "name" => "srh[GradeID]",
     "value" => $sGradeID, "option" => $aGradeOp,"select" => false,"def" => _("請選擇") , 'attr' => array("onchange=form.submit()") )));
    $aBody[] = array("flex" => '4', "body" => $eZui->setComboBox(array("head" => __("班級"), "name" => "srh[ClassYearID]",
     "value" => $sClassYearID, "option" => $aClassYearOp,"select" => false,"def" => _("請選擇") , 'attr' => array("onchange=form.submit()") )));

    $aBody[] = array('flex' => '4', 'body' => $eZui->setTextBox(array('head' => __('學號'), 'name' => 'text1', 'value' => old('text1') )));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setTextBox(array('head' => __('姓名'), 'name' => 'text2', 'value' => old('text2') )));
    $sTabHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'search')));
    $sTabHtml .= $eZui->setGroup(array('body' => $aBody));

    // ----- Grid 要顯示的欄位 -----
    $aField   = array();
    $aField[] = array("head" => _("填寫狀況"), "name" => "btn", "align" => "right");
    $aField[] = array("head" => _("班級"), "name" => "FieldName1", "width" => "33%", "align" => "center");
    $aField[] = array("head" => _("學號"), "name" => "FieldName2", "width" => "33%", "align" => "center");
    $aField[] = array("head" => _("姓名"), "name" => "FieldName3", "width" => "33%", "align" => "center");

    // 擷取要輸出到 Grid 的 Model 資料
    $aData = array();
    foreach ($data as $skData => $svData) {
        //隱藏（KEY）
        $aData[$skData]["FieldID"] = trim($svData["FieldID"]);

        //顯示
        $aData[$skData]["FieldName1"]         = trim($svData["FieldName1"]);
        $aData[$skData]["FieldName2"]         = trim($svData["FieldName2"]);
        $aData[$skData]["FieldName3"]         = trim($svData["FieldName3"]);

        $aBtn   = array();
        $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "c03240_tab2_view_tab1", "param" => array("view", trim($svData["FieldID"]))));
        $aData[$skData]["btn"] = implode("", $aBtn);
    }

    // fake data
    for($i = 0; $i <= 10; $i++)
    {
        $aData[$i]["FieldName1"] = 'Test Data';
        $aData[$i]["FieldName2"] = 'Test Data';
        $aData[$i]["FieldName3"] = 'Test Data';
        $aBtn   = array();
        $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "c03240_tab2_view_tab1", "param" => array("view", '')));
        $aData[$i]["btn"] = implode("", $aBtn);
    }

    $aSet = array(
        "field" => $aField,
        "data"  => $aData,
    );
    $sTabHtml .= $eZui->setGrid($aSet);

    $aParams =  array(
                'aTabInfo' => array(
                    'c03240' => array('title'=>'問卷狀況'),
                    'c03240_tab2' => array('title'=>'個人填寫狀況', 'view' => $sTabHtml, 'current' => 'active'),
                )
            );
    $sHtml = $eZui->setTab($aParams);

    echo $sHtml;
    @endphp
    {!! $eZui->setValidata('index') !!}
    </form>
@endsection
