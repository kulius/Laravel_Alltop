@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form method='POST' id='index'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

	$aBody   = array();
    $aBody[] = array("head" => _(""), "flex" => "4", "body" => $eZui->setFont(array("text" => _("匯入學生填答資料"), "size" => "1.3")));
    $aBody[] = array("flex" => "auto", "body" => $eZui->setJump(array('ex' => 'excel', "url" => "c03230_import", "param" => array("head" => "匯入學生填答資料", 'urlParam' => 'rpt'))) );
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    echo $sHtml;
    @endphp
    {!! $eZui->setValidata('index') !!}
    </form>
@endsection
