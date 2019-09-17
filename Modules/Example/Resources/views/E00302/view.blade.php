@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form id='main' method='POST' autocomplete='off' name='main' enctype='multipart/form-data'>
    {{ csrf_field() }}
	@php
    $sHTML = null;

    switch ($status) {
        case 'add':
        case 'edit':
            if($sStatus <= 1){
                $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'save', 'text' => '儲存並送出')));
                $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'save', 'value' => 'excute', 'text' => '儲存並決行')));
            }
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'click', 'value' => 'back', 'text' => '追回')));
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'e00302')));
            break;
        default:
            $aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'leave', 'route' => 'e00302')));
            break;
    }

    $sHTML .= $eZui->setGroup(array('body' => $aBody));

	$aBody   = array();
    $aBody[] = array("flex" => '4', "body" => $eZui->setTextBox(array('head' => __('學年'), 'name' => 'ACADYear', 'value' => $sYear, 'status' => 'view')));
    $aBody[] = array("flex" => '4', "body" => $eZui->setTextBox(array('head' => __('學期'), 'name' => 'Semester', 'value' =>  $sSem, 'status' => 'view')));
    $aBody[] = array("flex" => '4', "body" => $eZui->setTextBox(array('head' => __('申請日期'), 'name' => 'AbsentDate', 'value' => $ApplyDate, 'status' => 'view')));
    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array('flex' => '4', 'body' => $eZui->setJumpSel(array('head' => __('學號'), 'name' => 'StudentID', 'url' => 'e00302_StuSel', 'option' => $StudentOption, 'value' => $StudentID, 'param' => array('head' => '學生資料選擇'), 'status' => $status)));
    $aBody[] = array("flex" => '4', "body" => $eZui->setTextBox(array('head' => __('姓名'), 'name' => 'ChtName', 'value' => $ChtName, 'status' => 'view')));
    $aBody[] = array("flex" => '4', "body" => $eZui->setTextBox(array('head' => __('班級'), 'name' => 'ClassName', 'value' => $ClassName, 'status' => 'view')));
    $sHTML .= $eZui->setGroup(array('body' => $aBody));

    $aBody   = array();
    $aBody[] = array("flex" => "3", "body" => $eZui->setComboBox(array("head" => __("假別"), "name" => "LeaveKindID", "value" => $LeaveKindID, "option" => $LeaveKindOption, 'status' => $status)));

    $aBody2   = array();
    $aBody2[] = array("flex" => "6", "body" => $eZui->setDateBox(array("name" => "LeaveDateBeg", "value" => $LeaveDateBeg, 'status' => $status)));
    $aBody2[] = array("flex" => "6", "body" => $eZui->setDateBox(array("name" => "LeaveDateEnd", "value" => $LeaveDateEnd, 'status' => $status)));
    $sDateHtml = $eZui->setGroup(array('body' => $aBody2));

    $aBody[] = array("flex" => "4", "head" => __("請假日期"), "body" => $sDateHtml);
    $aBody[] = array("flex" => '5', "body" => $eZui->setTextArea(array('head' => __('假由'), 'name' => 'LeaveReason', 'value' => $LeaveReason, 'status' => $status)));
    $sHTML .= $eZui->setGroup(array('body' => $aBody));
    $aBody   = array();

    if(session()->has('SectionBlock') && session()->exists('SectionBlock')){
        $aSectionData = request()->session()->pull('SectionBlock');
        $aStuSectionSeq = session()->has('StuSectionSeq') ? request()->session()->pull('StuSectionSeq') : '';
        $SectionBlock = '<div class="table-responsive"><table class="table table-bordered"><thead><tr><th>請假日期</th><th>節次</th><th>節數</th></tr></thead>';
        foreach ($aSectionData as $AbsentDate => $aOption) {
            // 學生請假節次資料優先序: POST > 學生選擇節次 > null
            if(!is_null(old('Section_' . $AbsentDate))){
                $aStuSectionSeqData = old('Section_' . $AbsentDate);
            } else if(is_array($aStuSectionSeq) && array_key_exists($AbsentDate, $aStuSectionSeq)) {
                $aStuSectionSeqData = $aStuSectionSeq[$AbsentDate];
            }else{
                $aStuSectionSeqData = null;
            }
            // 節數
            $aStuSectionSeqLen = is_null($aStuSectionSeqData) ? 0 : count($aStuSectionSeqData);
            // 節次勾選 // TODO: 加入全選勾選框
            $SectionBlock .= '<tr><td>' . $AbsentDate . '</td>' .'<td>' . $eZui->setCheckBox(array('name' => 'Section_' . $AbsentDate, 'option' => $aOption, 'value' => $aStuSectionSeqData, 'status' => $status, 'inline' => true)) . '</td><td>' . $aStuSectionSeqLen . '</td>';
        }
        $SectionBlock .= '</tr></table></div>';
    } else {
        $SectionBlock = '<div id="SectionBlock"></div>';
    }
    $aBody[] = array("flex" => "12","body" => $SectionBlock);

    if(session()->has('IsUpload') && session()->get('IsUpload') === '1') {
        $aBody[] = array("flex" => "12", "head" => __("上傳檔案"), "body" => $eZui->setFileBox(array("name" => "AbsentFile", "value" => old('AbsentFile'))));
    }
    $sHTML .= $eZui->setGroup(array('body' => $aBody));

	@endphp
    {!! $sHTML !!}
    {!! $eZui->setValidata('main') !!}

    </form>
    <script type="text/javascript">
        var prevVal = '';
        var id = '';
        var state = '';
        function scanOption(id){
            var option = $('#StudentID').children('option');
            if(option.length > 0){
                if(option.val() != prevVal){
                    $('#ChtName').val('');
                    $('#ClassName').val('');
                    prevVal = option.val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route('e00302_getStuInfo') }}',
                        type: 'POST',
                        data: {
                            sYear: $('#ACADYear').val(),
                            sSem: $('#Semester').val(),
                            StudentID: option.val()
                        },
                        dataType: 'json',
                        success: function(data){
                            if(data != ''){
                                clearInterval(id);
                                $('#ChtName').val(data[0].ChtName);
                                $('#ClassName').val(data[0].ClassName);
                            }
                        },
                        error: function(msg){
                            console.log('Ajax Error!');
                        }
                    });
                }
            }
        }

        function setSectionGrid(){
            var LeaveDateBeg = $('#LeaveDateBeg').val();
            var LeaveDateEnd = $('#LeaveDateEnd').val();
            if((LeaveDateBeg != '' && LeaveDateEnd != '') && (Date.parse(LeaveDateBeg).valueOf() <= Date.parse(LeaveDateEnd).valueOf())){
                $('#SectionBlock').empty();
                $('form[name="main"]').submit();
            }else{
                $('#SectionBlock').empty();
                $('#SectionBlock').append('<font style="color: red;">請假日期起訖有誤!</font>');
            }
        }
        $(document).ready(function() {
            $('#StudentID').parent().siblings('button').click(function(){
                id = setInterval("scanOption(id)", 500);
            });
            $('#LeaveDateBeg, #LeaveDateEnd').on('blur', function(){
                var status = '{{ $status }}';
                if(status !== 'view'){
                    setSectionGrid();
                }
            });
            $('#LeaveKindID').on('change', function(){
                $('form[name="main"]').submit();
            });
        });
    </script>
@endsection
