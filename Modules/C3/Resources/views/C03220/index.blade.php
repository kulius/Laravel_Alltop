@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form method='POST' id='index'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody   = array();
    $aBody[] = array("head" => _("學年"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("108"), "size" => "1.0")));
    $aBody[] = array("head" => _("學期"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("第1學期"), "size" => "1.0")));
    $aBody[] = array("head" => _("班級"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("教育一甲"), "size" => "1.0")));

    $aBody[] = array("head" => _("學號"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("1057894"), "size" => "1.0")));
    $aBody[] = array("head" => _("姓名"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("王金發"), "size" => "1.0")));
    $aBody[] = array("head" => _("學籍狀況"), "flex" => "4", "body" => $eZui->setFont(array("text" => _("在學"), "size" => "1.0")));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'click','text' => '填寫當學期學習策略問卷', 'route' => 'c03220_fill', 'param' => array('fill'))));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    // ----- Grid 要顯示的欄位 -----
    $aField   = array();
    $aField[] = array("head" => _("功能"), "name" => "btn", "align" => "right");
    $aField[] = array("head" => _("學年"), "name" => "FieldName1", "width" => "15%", "align" => "center");
    $aField[] = array("head" => _("學期"), "name" => "FieldName2", "width" => "15%", "align" => "center");
    $aField[] = array("head" => _("問卷名稱"), "name" => "FieldName3", "width" => "25%", "align" => "center");
    $aField[] = array("head" => _("題目數量"), "name" => "FieldName4", "width" => "15%", "align" => "center");
    $aField[] = array("head" => _("問卷分數"), "name" => "FieldName5", "width" => "15%", "align" => "center");
    $aField[] = array("head" => _("學期總成績"), "name" => "FieldName6", "width" => "15%", "align" => "center");

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
        $aData[$skData]["FieldName5"]         = trim($svData["FieldName5"]);
        $aData[$skData]["FieldName6"]         = trim($svData["FieldName6"]);

        $aBtn   = array();
        $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "c03220_view", "param" => array("view", trim($svData["FieldID"]))));
        $aData[$skData]["btn"] = implode("", $aBtn);
    }

    // fake data
    for($i = 0; $i <= 5; $i++)
    {
        $aData[$i]["FieldName1"] = '106';
        $aData[$i]["FieldName2"] = '2';
        $aData[$i]["FieldName3"] = '問卷名稱A';
        $aData[$i]["FieldName4"] = '33';
        $aData[$i]["FieldName5"] = '80';
        $aData[$i]["FieldName6"] = '88';
        $aBtn   = array();
        $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "c03220_view", "param" => array("view", '')));
        $aData[$i]["btn"] = implode("", $aBtn);
    }

    $aSet = array(
        "field" => $aField,
        "data"  => $aData,
    );
    $sHtml .= $eZui->setGrid($aSet);

    $aBody = array();
    $noteContent = _("備註:<br>
                      &nbsp&nbsp 1.填寫當學期學習策略問卷:若填寫完畢且送出後，若需修改，在一定時間內此按鈕還會保存在此頁面，當時間截止時，此按鈕會消失，下方的清冊中會新增一筆當學年學期的問卷資料。"
                    );
    $aBody[] = array("flex" => "12", "body" => $eZui->setAlert(array("text" => $noteContent, "style" => "y")));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    echo $sHtml;
    @endphp
    {!! $eZui->setValidata('index') !!}
    </form>
@endsection
