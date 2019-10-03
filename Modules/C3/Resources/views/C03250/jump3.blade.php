@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.frame_modal')

@section('content')
    <form method='POST' id='index'>
    {{ csrf_field() }}
    @php
    $sHtml = null;

    $aBody   = array();
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('學年'), 'name' => 'drop1', 'value' => '', 'option' => '', 'req' => false, 'def' => '108')));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('學期'), 'name' => 'drop2', 'value' => '', 'option' => '', 'req' => false, 'def' => '第1學期')));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('部別'), 'name' => 'drop3', 'value' => '', 'option' => '', 'req' => false, 'def' => '-')));

    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('學制'), 'name' => 'drop4', 'value' => '', 'option' => '', 'req' => false, 'def' => '-')));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('學院'), 'name' => 'drop5', 'value' => '', 'option' => '', 'req' => false, 'def' => '-')));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('系所'), 'name' => 'drop6', 'value' => '', 'option' => '', 'req' => false, 'def' => '-')));

    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('組別'), 'name' => 'drop7', 'value' => '', 'option' => '', 'req' => false, 'def' => '-')));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('年級'), 'name' => 'drop8', 'value' => '', 'option' => '', 'req' => false, 'def' => '-')));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setComboBox(array('head' => _('班級'), 'name' => 'drop9', 'value' => '', 'option' => '', 'req' => false, 'def' => '-')));

    $aBody[] = array('flex' => '4', 'body' => $eZui->setTextBox(array('head' => __('學號'), 'name' => 'text1', 'value' => old('text1') )));
    $aBody[] = array('flex' => '4', 'body' => $eZui->setTextBox(array('head' => __('姓名'), 'name' => 'text2', 'value' => old('text2') )));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'excel')));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    echo $sHtml;
    @endphp
    {!! $eZui->setValidata('index') !!}
    </form>
@endsection
