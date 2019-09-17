@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.frame_default')

@section('content')
<form id="form1" name="form1" class="form-horizontal form-label-left" enctype="multipart/form-data" method="post" onsubmit="submitContent()">
{{method_field('PUT')}}

<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="main_img">展示主圖 <span class="required">*</span></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div id="inputBox">
            <input type="file" title="請選擇圖片" id="mainImg" name="main_img" required multiple accept="image/png,image/jpg,image/gif,image/JPEG"/>
            <div id="mainImgBox"></div>
        </div>
    </div>
</div>
<input type="submit" value="Submit">
{{ csrf_field() }}


</form>
@endsection
