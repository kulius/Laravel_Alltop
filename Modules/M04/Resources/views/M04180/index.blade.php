@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' autocomplete='off'>
    {{ csrf_field() }}
    @php
//TODO:列印彈跳
    $sHtml = null;
    $aBody   = array();
    $aBody[] = array("head" => _(""), "flex" => "6", "body" => $eZui->setFont(array("text" => _("滿意度調查總表"), "size" => "1.0")));
    $aBody[] = array("flex" => "auto", "body" => $eZui->setJump(array("icon"=>"print", "text" => "列印", "name" => "import", "url" => "a01210_import_jump", "param" => array("head" => "滿意度調查總表"))) );
    $sHtml .= $eZui->setGroup(array('body' => $aBody));
    $aBody   = array();
    $aBody[] = array("head" => _(""), "flex" => "6", "body" => $eZui->setFont(array("text" => _("滿意度調查統計表"), "size" => "1.0")));
    $aBody[] = array("flex" => "auto", "body" => $eZui->setJump(array("icon"=>"print", "text" => "列印", "name" => "import", "url" => "a01210_import_jump", "param" => array("head" => "滿意度調查統計表"))) );
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    @endphp
        {!! $sHtml !!}
        {!! $eZui->setValidata('main') !!}
</form>
@endsection
