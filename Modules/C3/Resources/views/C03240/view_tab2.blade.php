@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form method='POST' id='index'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody   = array();
    $sGetParam = null;
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnHref(array("ex" => "leave", 'route' => 'c03240', 'param' => array($sGetParam))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $sTabHtml = null;
	$aBody   = array();

    $aBody[] = array("head" => _("學年"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("FontContent"), "size" => "1.0")));
    $aBody[] = array("head" => _("學期"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("FontContent"), "size" => "1.0")));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('部別'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇', 'attr' => array("onchange=form.submit()"))));

    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('學制'), 'name' => 'drop1', 'value' => '', 'option' => '', 'req' => false, 'def' => '-')));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('學院'), 'name' => 'drop2', 'value' => '', 'option' => '', 'req' => false, 'def' => '-')));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('系所'), 'name' => 'drop3', 'value' => '', 'option' => '', 'req' => false, 'def' => '-')));

    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'search')));

    $sTabHtml .= $eZui->setGroup(array('body' => $aBody));

    // ----- Grid 要顯示的欄位 -----
    $aField   = array();
    $aField[] = array("head" => _("年級"), "name" => "FieldName1", "width" => "25%", "align" => "center");
    $aField[] = array("head" => _("題號"), "name" => "FieldName2", "width" => "25%", "align" => "center");
    $aField[] = array("head" => _("題目名稱"), "name" => "FieldName3", "width" => "25%", "align" => "center");
    $aField[] = array("head" => _("得分"), "name" => "FieldName4", "width" => "25%", "align" => "center");

    // 擷取要輸出到 Grid 的 Model 資料
    $aData = array();
    foreach ($data as $skData => $svData) {
        //隱藏（KEY）
        $aData[$skData]["FieldID"] = trim($svData["FieldID"]);
        //顯示
        $aData[$skData]["FieldName1"]         = trim($svData["FieldName1"]);
        $aData[$skData]["FieldName2"]         = trim($svData["FieldName2"]);
        $aData[$skData]["FieldName3"]         = trim($svData["FieldName3"]);
        $aData[$skData]["FieldName4"]         = trim($svData["FieldName4"]);
    }

    // fake data
    for($i = 0; $i <= 10; $i++)
    {
        $aData[$i]["FieldName1"] = 'Test Data';
        $aData[$i]["FieldName2"] = 'Test Data';
        $aData[$i]["FieldName3"] = 'Test Data';
        $aData[$i]["FieldName4"] = 'Test Data';
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
                    'c03240_view_tab1' => array('title'=>'學期總平均'),
                    'c03240_view_tab2' => array('title'=>'學習策略系所總表', 'view' => $sTabHtml, 'current' => 'active'),
                )
            );
	$sHtml .= $eZui->setTab($aParams);

	$aBody   = array();
    $sGetParam = null;
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnHref(array("ex" => "leave", 'route' => 'c03240', 'param' => array($sGetParam))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    echo $sHtml;
    @endphp
    {!! $eZui->setValidata('index') !!}
    </form>
@endsection
