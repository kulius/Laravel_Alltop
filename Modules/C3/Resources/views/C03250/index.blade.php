@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form method='POST' id='index'>
    {{ csrf_field() }}
    <?php
$sHtml = null;

$aBody   = array();
$aBody[] = array("head" => _(""), "flex" => "4", "body" => $eZui->setFont(array("text" => _("學習策略問卷結果篩選條件"), "size" => "1.3")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setJump(array('ex' => 'print', "url" => "c03250_jump1", "param" => array("head" => "學習策略問卷結果篩選條件", 'urlParam' => 'rpt'))));
$sHtml .= $eZui->setGroup(array('body' => $aBody));

$aBody   = array();
$aBody[] = array("head" => _(""), "flex" => "4", "body" => $eZui->setFont(array("text" => _("學習策略問卷填答狀況統計表篩選條件"), "size" => "1.3")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setJump(array('ex' => 'print', "url" => "c03250_jump2", "param" => array("head" => "學習策略問卷填答狀況統計表篩選條件"), 'urlParam' => 'c03250_02')));
$sHtml .= $eZui->setGroup(array('body' => $aBody));

$aBody   = array();
$aBody[] = array("head" => _(""), "flex" => "4", "body" => $eZui->setFont(array("text" => _("個別學習策略問卷填答狀況篩選條件"), "size" => "1.3")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setJump(array('ex' => 'print', "url" => "c03250_jump3", "param" => array("head" => "個別學習策略問卷填答狀況篩選條件", 'urlParam' => 'rpt'))));
$sHtml .= $eZui->setGroup(array('body' => $aBody));

$aBody   = array();
$aBody[] = array("head" => _(""), "flex" => "4", "body" => $eZui->setFont(array("text" => _("系所學習策略總表篩選條件"), "size" => "1.3")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setJump(array('ex' => 'print', "url" => "c03250_jump4", "param" => array("head" => "系所學習策略總表篩選條件", 'urlParam' => 'rpt'))));
$sHtml .= $eZui->setGroup(array('body' => $aBody));

$aBody   = array();
$aBody[] = array("head" => _(""), "flex" => "4", "body" => $eZui->setFont(array("text" => _("學習策略問卷尚未填答一覽表篩選條件"), "size" => "1.3")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setJump(array('ex' => 'print', "url" => "c03250_jump1", "param" => array("head" => "學習策略問卷尚未填答一覽表篩選條件", 'urlParam' => 'rpt'))));
$sHtml .= $eZui->setGroup(array('body' => $aBody));

$aBody   = array();
$aBody[] = array("head" => _(""), "flex" => "4", "body" => $eZui->setFont(array("text" => _("各系學習策略問卷填答狀況篩選條件"), "size" => "1.3")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setJump(array('ex' => 'print', "url" => "c03250_jump4", "param" => array("head" => "各系學習策略問卷填答狀況篩選條件", 'urlParam' => 'rpt'))));
$sHtml .= $eZui->setGroup(array('body' => $aBody));

$aBody   = array();
$aBody[] = array("head" => _(""), "flex" => "4", "body" => $eZui->setFont(array("text" => _("各學期問卷結果變化篩選條件"), "size" => "1.3")));
$aBody[] = array("flex" => "auto", "body" => $eZui->setJump(array('ex' => 'print', "url" => "c03250_jump5", "param" => array("head" => "各學期問卷結果變化篩選條件", 'urlParam' => 'rpt'))));
$sHtml .= $eZui->setGroup(array('body' => $aBody));

echo $sHtml;
?>
    {!! $eZui->setValidata('index') !!}
    </form>
@endsection
