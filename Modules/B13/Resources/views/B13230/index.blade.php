@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aOption   = array();
    $aOption[] = array("value" => "1", "text" => _("1"));
    $aOption[] = array("value" => "2", "text" => _("2"));

    $aBody   = array();
    $aBody[] = array('flex' => '3', 'body' => $eZui->setComboBox(array('head' => _('所屬大樓'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇')));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setComboBox(array('head' => _('所在樓層'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇')));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setComboBox(array('head' => _('場地類型'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇')));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setComboBox(array('head' => _('場地名稱'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇',)));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setComboBox(array('head' => _('管理單位'), 'name' => 'drop', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇',)));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setDateTimeBox(array('head' => _('租借日期(每次顯示一週)'), 'name' => '17', 'value' => '', 'option' => '', 'req' => false, 'def' => '請選擇')));

    $sHtml .= $eZui->setGroup(array('body' => $aBody));
    $aBody = array();
    $aBody[] = array("flex" => 'auto', "body" => $eZui->setBtnSubmit(array('ex' => 'search', 'value' => 'search')));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    // ----- Table 要顯示的欄位 -----
    $aField   = array();
    $aField[] = array("head" => _("節次\星期"), "name" => "0", "width" => "15%", "align" => "center");
    $aField[] = array("head" => _("星期一"), "name" => "1", "width" => "10%", "align" => "center");
    $aField[] = array("head" => _("星期二"), "name" => "2", "width" => "10%", "align" => "center");
    $aField[] = array("head" => _("星期三"), "name" => "3", "width" => "10%", "align" => "center");
    $aField[] = array("head" => _("星期四"), "name" => "4", "width" => "10%", "align" => "center");
    $aField[] = array("head" => _("星期五"), "name" => "5", "width" => "10%", "align" => "center");
    $aField[] = array("head" => _("星期六"), "name" => "6", "width" => "10%", "align" => "center");
    $aField[] = array("head" => _("星期日"), "name" => "7", "width" => "10%", "align" => "center");


    // ----- 列出節次 1 - 11 的 Check 按紐 -----
    $aData = array();
    for($i = 0; $i <= 13; $i++)
    {
        switch ($i) {
            case 0:
                $aData[$i]["0"]= "第一節";
                break;
            case 1:
                $aData[$i]["0"]= "第二節";
                break;
            case 2:
                $aData[$i]["0"]= "第三節";
                break;
            case 3:
                $aData[$i]["0"]= "第四節";
                break;
            case 4:
                $aData[$i]["0"]= "午間";
                break;
            case 5:
                $aData[$i]["0"]= "第五節";
                break;
            case 6:
                $aData[$i]["0"]= "第六節";
                break;
            case 7:
                $aData[$i]["0"]= "第七節";
                break;
            case 8:
                $aData[$i]["0"]= "第八節";
                break;
            case 9:
                $aData[$i]["0"]= "晚間";
                break;
            case 10:
                $aData[$i]["0"]= "第九節";
                break;
            case 11:
                $aData[$i]["0"]= "第十節";
                break;
            case 12:
                $aData[$i]["0"]= "第十一節";
                break;
            case 13:
                $aData[$i]["0"]= "第十二節";
                break;

            default:
                $aData[$i]["0"]= "第一節";
                break;
        }


        $aData[$i]["1"]= $aBody[] = $eZui->setTextBox(array('name' => 'check', 'value' => "",'status'=>"view"));
        $aData[$i]["2"]= $aBody[] = $eZui->setTextBox(array('name' => 'check', 'value' => "",'status'=>"view"));
        $aData[$i]["3"]= $aBody[] = $eZui->setTextBox(array('name' => 'check', 'value' => "",'status'=>"view"));
        $aData[$i]["4"]= $aBody[] = $eZui->setTextBox(array('name' => 'check', 'value' => "",'status'=>"view"));
        $aData[$i]["5"]= $aBody[] = $eZui->setTextBox(array('name' => 'check', 'value' => "",'status'=>"view"));
        $aData[$i]["6"]= $aBody[] = $eZui->setTextBox(array('name' => 'check', 'value' => "",'status'=>"view"));
        $aData[$i]["7"]= $aBody[] = $eZui->setTextBox(array('name' => 'check', 'value' => "",'status'=>"view"));
    }

    $aSet = array(
        "field" => $aField,
        "data"  => $aData,
    );
    $sHtml .= $eZui->setTable($aSet);

    $aParams = array(
    'aTabInfo' => array(
    'b13230' => array('param' => "", 'title'=>'業務承辦人', 'view' => $sHtml, 'current' => 'active'),
    'b13230_tab2' => array('param' => "", 'title'=>'多間場地查詢'),
    )
    );
    $sHtml = $eZui->setTab($aParams);
    @endphp
        {!! $sHtml !!}
        {!! $eZui->setValidata('main') !!}
</form>
@endsection
