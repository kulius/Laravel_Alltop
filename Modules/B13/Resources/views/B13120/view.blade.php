@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')


@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody=array();
        switch ($status) {
        case 'add':
        case 'edit':
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'b13120')));
        break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'b13120')));
        break;
    }
    $sHtml .= $eZui->setGroup(array('body' => $aBody));
    $sStatus = $status != "add" ? "view" : "";

    $aOption   = array();
    $aOption[] = array("value" => "1", "text" => _("-"));
    $aOption[] = array("value" => "2", "text" => _("行政大樓"));
    $aOption[] = array("value" => "3", "text" => _("科學館"));
    $aOption[] = array("value" => "4", "text" => _("明德樓"));
    $aOption[] = array("value" => "5", "text" => _("芳蘭樓"));
    $aOption[] = array("value" => "6", "text" => _("創意館"));
    $aOption[] = array("value" => "7", "text" => _("視聽館"));
    $aOption[] = array("value" => "8", "text" => _("至善樓"));
    $aOption[] = array("value" => "9", "text" => _("圖書館"));
    $aOption[] = array("value" => "10", "text" => _("體育館"));
    $aOption[] = array("value" => "11", "text" => _("藝術館"));
    $aOption[] = array("value" => "12", "text" => _("篤行樓"));

    $aBody = array();
    $aBody[] = array("flex" => '2', "body" => $eZui->setComboBox(array("head" => __("學年"), "name" => "Semester_srh", "value" => old("Semester_srh"),'req'=>true, "option" => $aOption,"def" => _("請選擇"))));
    $aBody[] = array("flex" => '2', "body" => $eZui->setComboBox(array("head" => __("學期"), "name" => "DayfgID_srh", "value" => old("DayfgID_srh"), "option" => $aOption,"def" => _("請選擇"))));
    $aBody[] = array("flex" => '2', "body" => $eZui->setComboBox(array("head" => __("審核單位"), "name" => "ClassTypeID_srh", "value" => old("ClassTypeID_srh"),"option" => $aOption,  "def" => _("請選擇"))));
    $aBody[] = array("flex" => '2', "body" => $eZui->setComboBox(array("head" => __("所屬大樓"),'status'=>'view', "name" => "College_srh", "value" => old("College_srh"),'req'=>true, "option" => $aOption, "def" => _("請選擇"))));
    $aBody[] = array("flex" => '2', "body" => $eZui->setComboBox(array("head" => __("所在樓層"),'status'=>'view', "name" => "College_srh", "value" => old("College_srh"), "option" => $aOption, "def" => _("請選擇"))));
    $aBody[] = array("flex" => '2', "body" => $eZui->setComboBox(array("head" => __("場地類型"),'status'=>'view', "name" => "College_srh", "value" => old("College_srh"), "option" => $aOption, "def" => _("請選擇"))));
    $aBody[] = array("flex" => '2', "body" => $eZui->setComboBox(array("head" => __("場地名稱"),'status'=>'view', "name" => "College_srh", "value" => old("College_srh"), "option" => $aOption, "def" => _("請選擇"))));
    $aBody[] = array("flex" => '2', "body" => $eZui->setComboBox(array("head" => __("管理單位"),'status'=>'view', "name" => "College_srh", "value" => old("College_srh"), "option" => $aOption, "def" => _("請選擇"))));
    $aBody[] = array("flex" => '2', "body" => $eZui->setComboBox(array("head" => __("容納人數大於"),'status'=>'view', "name" => "College_srh", "value" => old("College_srh"), "option" => $aOption, "def" => _("請選擇"))));
    $aBody[] = array("flex" => '2', "body" => $eZui->setComboBox(array("head" => __("開放排課"), "name" => "College_srh", "value" => old("College_srh"), "option" => $aOption, "def" => _("請選擇"))));

    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aField   = array();
    $aField[] = array("head" => _("節次名稱"), "name" => "Result", "width" => "10%", "align" => "left");
    $aField[] = array("head" => _("星期一"), "name" => "Result", "width" => "10%", "align" => "left");
    $aField[] = array("head" => _("星期二"), "name" => "Result", "width" => "10%", "align" => "left");
    $aField[] = array("head" => _("星期三"), "name" => "Result", "width" => "10%", "align" => "left");
    $aField[] = array("head" => _("星期四"), "name" => "Result", "width" => "10%", "align" => "left");
    $aField[] = array("head" => _("星期五"), "name" => "Result", "width" => "10%", "align" => "left");
    $aField[] = array("head" => _("星期六"), "name" => "Result", "width" => "10%", "align" => "left");
    $aField[] = array("head" => _("星期日"), "name" => "Result", "width" => "10%", "align" => "left");


    // 擷取要輸出到 Grid 的 Model 資料
    $aData = array();
    foreach ($data as $skData => $svData) {
        // $aData[$skData]["Year"]         = trim($svData["Year"]);
        // $aData[$skData]["Number"]         = trim($svData["Number"]);
        // $aData[$skData]["Comment"]         = trim($svData["Comment"]);
        // $aData[$skData]["Coin"]         = trim($svData["Coin"]);
        $aData[$skData]["Result"]         = trim($svData["Result"]);
        // $aBtn   = array();
        // $aBtn[] = $eZui->setBtnHref(array("ex" => "view", "small" => true, "route" => "b13120_view", "param" => array("view")));
        // $aBtn[] = $eZui->setBtnHref(array("ex" => "edit", "small" => true, "route" => "b13120_view", "param" => array("edit")));

        // $aData[$skData]["btn"]            = implode("", $aBtn);
    }

    // // ----- 資料顯示 & 設定 Grid 上方之功能紐 -----
    $aSet = array(
        "id"=>"b13120_view",
        "field" => $aField,
        "data"  => $aData,
        // remove:刪除, select:選取, stop:停復用
        "btn"   => array("remove"),
    );
    // $sHtml .= $eZui->setGrid($aSet);
    $sHtml .= $eZui->setGridMUL($aSet);





    @endphp
    {!! $sHtml !!}
    {!! $eZui->setValidata('main') !!}
</form>
@endsection
