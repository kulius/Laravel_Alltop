@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.frame_modal')

@section('content')
    <form method='POST' id='index'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody = array();
    // 範本參考 route:a01210_file_sample & A01210\jump\excel.blade.php
    $aBody[] = array("body" => $eZui->setBtnHref(array("head" => _("匯入EXCEL檔案範本"), "ex" => "download", "route" => "a01210_file_sample")));
    $sHtml .= $eZui->setGroup(array("body" => $aBody));

    $aBody = array();
    $aBody[] = array("body" => $eZui->setFileBox(array("head" => _("選擇檔案"), "name" => "file", "value" => old('file[]'))));
    $sHtml .= $eZui->setGroup(array("body" => $aBody));

    $aBody   = array();
    $aBody[] = array("flex" => "auto", "body" => $eZui->setBtnSubmit(array("ex" => "import", "value" => "import")));
    $sHtml .= $eZui->setGroup(array("body" => $aBody));

    echo $sHtml;
    @endphp
    {!! $eZui->setValidata('index') !!}
    </form>
@endsection
