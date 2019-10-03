@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody = array();
    $aBody[] = array("flex" => '2', "body" => $eZui->setComboBox(array("head" => __("學年"), "name" => "srh[ACADYear]",
     "value" => $sYear, "option" => $aYearOp, "select" => false,"def" => _("請選擇") , 'attr' => array("onchange=form.submit()")  )));
    $aBody[] = array("flex" => '2', "body" => $eZui->setComboBox(array("head" => __("學期"), "name" => "srh[Semester]",
     "value" => $sSem, "option" => $aSemOp,"select" => false,"def" => _("請選擇") , 'attr' => array("onchange=form.submit()") )));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody = array();
    $aBody[] = array("flex" => 'auto', "body" => $eZui->setBtnHref(array('ex' => 'add', 'value' => 'add', 'route' => 'b13160_view', 'param' => array('add'))));
    $aBody[] = array("flex" => 'auto', "body" => $eZui->setBtnSubmit(array('ex' => 'search', 'value' => 'search')));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aField   = array();
    $aField[] = array("head" => _("學年度"), "name" => "Result", "width" => "10%", "align" => "left");
    $aField[] = array("head" => _("學期"), "name" => "Result", "width" => "10%", "align" => "left");
    $aField[] = array("head" => _("教室名稱"), "name" => "Result", "width" => "10%", "align" => "left");
    $aField[] = array("head" => _("所屬大樓"), "name" => "Result", "width" => "10%", "align" => "left");
    $aField[] = array("head" => _("開始申請日期"), "name" => "Result", "width" => "10%", "align" => "left");
    $aField[] = array("head" => _("結束申請日期"), "name" => "Result", "width" => "10%", "align" => "left");
    $aField[] = array("head" => _("功能"), "name" => "btn", "width" => "10%", "align" => "left");

    // 擷取要輸出到 Grid 的 Model 資料
    $aData = array();
    foreach ($data as $skData => $svData) {
        // $aData[$skData]["Year"]         = trim($svData["Year"]);
        // $aData[$skData]["Number"]         = trim($svData["Number"]);
        // $aData[$skData]["Comment"]         = trim($svData["Comment"]);
        // $aData[$skData]["Coin"]         = trim($svData["Coin"]);
        $aData[$skData]["Result"]         = trim($svData["Result"]);
        $aBtn   = array();
        $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "b13160_view", "param" => array("view")));
        $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "b13160_view", "param" => array("edit")));

        $aData[$skData]["btn"]            = implode("", $aBtn);
    }

    // // ----- 資料顯示 & 設定 Grid 上方之功能紐 -----
    $aSet = array(
        "id"=>"b13160",
        "field" => $aField,
        "data"  => $aData,
        // remove:刪除, select:選取, stop:停復用
        "btn"   => array("remove"),
    );
    // $sHtml .= $eZui->setGrid($aSet);
    $sHtml .= $eZui->setGridMUL($aSet);
    //echo $sHtml;
    @endphp
        {!! $sHtml !!}
        {!! $eZui->setValidata('main') !!}
</form>
@endsection
