@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form method='POST' id='index'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody   = array();
    $sGetParam = null;
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnHref(array("ex" => "leave", 'route' => 'c03240_tab2', 'param' => array($sGetParam))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $sTabHtml = null;
	$aBody   = array();

    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('學年'), 'name' => 'drop1', 'value' => '', 'option' => '', 'req' => false, 'def' => '-')));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('學期'), 'name' => 'drop2', 'value' => '', 'option' => '', 'req' => false, 'def' => '-')));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('系所'), 'name' => 'drop3', 'value' => '', 'option' => '', 'req' => false, 'def' => '-')));

    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('班級'), 'name' => 'drop1', 'value' => '', 'option' => '', 'req' => false, 'def' => '-')));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setTextBox(array('head' => __('學號'), 'name' => 'text1', 'value' => old('text1') )));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setTextBox(array('head' => __('姓名'), 'name' => 'text2', 'value' => old('text2') )));

    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'search')));

	$sTabHtml .= $eZui->setGroup(array('body' => $aBody));

    // ----- Grid 要顯示的欄位 -----
    $aField   = array();
    $aField[] = array("head" => _("題號"), "name" => "FieldName1", "width" => "20%", "align" => "center");
    $aField[] = array("head" => _("題目"), "name" => "FieldName2", "width" => "60%", "align" => "center");
    $aField[] = array("head" => _("答案名稱"), "name" => "FieldName3", "width" => "20%", "align" => "center");

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
        $aData[$skData]["btn"] = implode("", $aBtn);
    }

    // fake data
    for($i = 0; $i <= 10; $i++)
    {
        $aData[$i]["FieldName1"] = $i;
        $aData[$i]["FieldName2"] = '學習時，我會檢視自己對於書本內容的理解程度。';
        $aData[$i]["FieldName3"] = '非常滿意';
        $aBtn   = array();
        $aData[$i]["btn"] = implode("", $aBtn);
    }

    $aSet = array(
        "field" => $aField,
        "data"  => $aData,
    );
    $sTabHtml .= $eZui->setGrid($aSet);

    $aParams =  array(
                'aTabInfo' => array(
                    'c03240_tab2_view_tab1' => array('title'=>'學習策略個人'),
                    'c03240_tab2_view_tab2' => array('title'=>'學生填寫問卷狀況', 'view' => $sTabHtml, 'current' => 'active'),
                )
            );
	$sHtml .= $eZui->setTab($aParams);

	$aBody   = array();
    $sGetParam = null;
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnHref(array("ex" => "leave", 'route' => 'c03240_tab2', 'param' => array($sGetParam))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    echo $sHtml;
    @endphp
    {!! $eZui->setValidata('index') !!}
    </form>
@endsection
