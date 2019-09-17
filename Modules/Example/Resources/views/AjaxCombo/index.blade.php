@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
    <form method='POST' id="index">
    {{ csrf_field() }}
	@php
    $sHtml = null;


    $aBody[] = array('flex' => '2', 'body' => $eZui->setComboBox(array('head' => _('學年'), 'name' => 'Year', 'value' => $sYear, 'option' => $aYearCombo, 'req' => false)));
    $aBody[] = array('flex' => '2', 'body' => $eZui->setComboBox(array('head' => _('學期'), 'name' => 'Semester', 'value' => $sSemester, 'option' => $aSemesterCombo, 'req' => false)));
    $aBody[] = array('flex' => '2', 'body' => $eZui->setComboBox(array('head' => _('部別'), 'name' => 'Dayfg', 'value' => $sDayfg, 'option' => $aDayfgCombo, 'req' => false)));
    $aBody[] = array('flex' => '2', 'body' => $eZui->setComboBox(array('head' => _('學制'), 'name' => 'ClassType', 'value' => $sClassType, 'option' => $aClassTypeCombo, 'req' => false)));
    $aBody[] = array('flex' => '2', 'body' => $eZui->setComboBox(array('head' => _('學院'), 'name' => 'College', 'value' => $sCollege, 'option' => $aCollegeCombo, 'req' => false)));
    $aBody[] = array('flex' => '2', 'body' => $eZui->setComboBox(array('head' => _('系所'), 'name' => 'Unit', 'value' => $sUnit, 'option' => $aUnitCombo, 'req' => false)));


    $sHtml .= $eZui->setGroup(array('body' => $aBody));

    echo $sHtml;
    @endphp
    {!! $eZui->setValidata('index') !!}
    </form>

<script type="text/javascript">
    $(document).ready(function(){
        $('#ClassType').change(function(){
            ChangeClassType();
        });

        $('#College').change(function(){
            ChangeCollege();
        });
    });

    function ChangeClassType(){
       var sYear = $('#Year option:selected').val();
       var sSemester = $('#Semester option:selected').val();
       var sDayfg = $('#Dayfg option:selected').val();
       $('#ClassType').empty().append($('<option></option>').val('').text('------'));

       var selectText = $('#ClassType option:selected').text();
       if ($.trim(selectText).length > 0 && selectText != "請選擇頁面"){
            getClassTypeRelateCombo(sYear, sSemester, sDayfg);
       }
    }

    function getClassTypeRelateCombo(sYear, sSemester, sDayfg){
       var sClassType = $('#ClassType option:selected').val();

        $.ajax({
                url: {!! "'" . route('e00305_ClassType') ."'" !!},
                data: { Year: sYear, Semester: sSemester, Dayfg: sDayfg, ClassType: sClassType },
                type: 'get',
                cache: false,
                //async: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function (data) {
                   // if (data..length > 0) {
                        $('#ClassType').empty();
                        //$('#ClassType').append($('<option></option>').val('').text('請選擇區塊'));
                        $.each(data.ClassType, function (i, item) {
                            //$('#ClassType').append(item);
                            //console.log(item);
                            $('#ClassType').append($('<option></option>').val(item.value).text(item.text));
                        });


                        $('#College').empty();
                      //  $('#College').append($('<option></option>').val('').text('請選擇區塊'));
                        $.each(data.College, function (i, item) {
                            //$('#College').append(item);
                            //console.log(item);
                            $('#College').append($('<option></option>').val(item.value).text(item.text));
                        });

                        $('#Unit').empty();
                        console.log(data.Unit.length);
                        $.each(data.Unit, function (i, item) {
                            //$('#College').append(item);
                            console.log(item);
                             $('#Unit').append($('<option></option>').val(item.value).text(item.text));
                        });

                        $('#ClassType').selectpicker('refresh');
                        $('#College').selectpicker('refresh');
                        $('#Unit').selectpicker('refresh');
                    }
                //}
            });
    }

</script>

@endsection
