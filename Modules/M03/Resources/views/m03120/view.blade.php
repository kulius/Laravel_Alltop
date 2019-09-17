@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form id='main' method='POST' enctype='multipart/form-data'>
{{ csrf_field() }}
<?php
$html = null;

$body = array();

switch ($status) {
    case 'add':
    case 'edit':
        $body[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save')));
        $body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm03120')));
        break;
    default:
        $body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'm03120')));
        break;
}

$html .= $eZui->setGroup(array('body' => $body));
?>
{!! $html !!}
{!! $eZui->setValidata('main') !!}

<nav>
    <div class='nav nav-tabs mb-3' id='nav-tab' role='tablist'>
        <a class='nav-item nav-link active' id='nav_tab_0' data-toggle='tab' href='#nav_0' role='tab' aria-controls='nav_0' aria-selected='true'>
            {{ _i('公告設定') }}
        </a>
    </div>
</nav>
<div class='tab-content' id='nav-tabContent'>
    <div class='tab-pane fade show active' id='nav_0' role='tabpanel' aria-labelledby='nav_tab_0'>
        @include('m03::m03120.view_1')
    </div>
</div>

<form>
@endsection

@section('javascript')
<script>
    setMail();

    function setMail() {
        type = $('input[name="board_type[]"]:checked').val();

        if (type == 'c' || type == 'd') {
            $('#mail_set').css('display','block');
        } else {
            $('#mail_set').css('display','none');
        }
    }
</script>
@endsection
