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

    $aOption = array();
    $aOption[] = array('value' => 1, 'text' => '全校之比較');
    $aOption[] = array('value' => 2, 'text' => '同學院不同系之比較');
    $aOption[] = array('value' => 3, 'text' => '同系不同班之比較');
    $aOption[] = array('value' => 4, 'text' => '各班之比較');
    $aBody[] = array('flex' => '12', 'body' => $eZui->setCheckBox(array('head' => _(''), 'name' => 'check', 'value' => ['check'], 'option' => $aOption, 'req' => false, 'min' => '3')));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'excel')));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    echo $sHtml;
    @endphp
    {!! $eZui->setValidata('index') !!}
    </form>
@endsection
