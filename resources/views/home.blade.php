@inject('eZui', 'App\Alltop\BaseView')

@extends('layouts.master')

@section('content')
<form method='POST'>
{{ csrf_field() }}
	<div class="row">
		<div class="col-lg-3 col-6">
	    	<div class="small-box bg-info">
	      		<div class="inner">
	        		<h3><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">10</font></font></h3>

	        		<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">收件夾</font></font></p>
	      		</div>

	      		<div class="icon">
	        		<i class="far fa-envelope"></i>
	      		</div>

	      		<a href="#" class="small-box-footer"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">點擊前往 </font></font><i class="fas fa-arrow-circle-right"></i></a>
	    	</div>
	  	</div>

	  	<div class="col-lg-3 col-6">
	    	<div class="small-box bg-success">
	      		<div class="inner">
	        		<h3><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2</font></font></h3>

	        		<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">代理夾</font></font></p>
	      		</div>

	      		<div class="icon">
	        		<i class="far fa-user"></i>
	      		</div>

	     		<a href="#" class="small-box-footer"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">點擊前往 </font></font><i class="fas fa-arrow-circle-right"></i></a>
	    	</div>
	  	</div>

	  	<div class="col-lg-3 col-6">
	    	<div class="small-box bg-warning">
	      		<div class="inner">
	        		<h3><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1</font></font></h3>

	        		<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">退文夾</font></font></p>
	      		</div>

	     		<div class="icon">
	        		<i class="fas fa-undo-alt"></i>
	      		</div>

	      		<a href="#" class="small-box-footer"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">點擊前往 </font></font><i class="fas fa-arrow-circle-right"></i></a>
	    	</div>
	  	</div>

	  	<div class="col-lg-3 col-6">
	    	<div class="small-box bg-danger">
	      		<div class="inner">
	        		<h3><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3</font></font></h3>

	        		<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">暫存夾</font></font></p>
	      		</div>

	      		<div class="icon">
	        		<i class="far fa-folder-open"></i>
	      		</div>

	      		<a href="#" class="small-box-footer"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">點擊前往 </font></font><i class="fas fa-arrow-circle-right"></i></a>
	    	</div>
	  	</div>
	</div>
<?php
$html  = null;
$group = null;

$body   = array();
$body[] = array('body' => $eZui->setTextBox(array('head' => _i('公告代號'), 'name' => 'board_number', 'value' => request()->input('board_number'))));

$group .= $eZui->setGroup(array('body' => $body));

$body   = array();
$body[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'search')));

$group .= $eZui->setGroup(array('body' => $body));

$field   = array();
$field[] = array('head' => _i('公告代號'), 'name' => 'board_number', 'width' => '10%');
$field[] = array('head' => _i('公告主旨'), 'name' => 'board_title');
$field[] = array('head' => _i('開始日期'), 'name' => 'board_start_date', 'width' => '10%');
$field[] = array('head' => _i('結束日期'), 'name' => 'board_end_date', 'width' => '10%');
$field[] = array('head' => _i('功能'), 'name' => 'btn', 'width' => '5%');

$data = array();

foreach ($data_board as $_key => $_value) {
    $board_number          = trim($_value['board_number']);
    $board_title           = trim($_value['board_title']);
    $board_start_date      = trim($_value['board_start_date']);
    $board_start_date_text = ($board_start_date ? date('Y-m-d', strtotime($board_start_date)) : $board_start_date);
    $board_end_date        = trim($_value['board_end_date']);
    $board_end_date_text   = ($board_end_date ? date('Y-m-d', strtotime($board_end_date)) : $board_end_date);

    $btn   = array();
    $btn[] = $eZui->setBtnHref(array('ex' => 'view', 'small' => true, 'cmd' => 'view', 'route' => 'm03120_view', 'param' => array('view', $board_number)));

    $data[$_key]['board_number']     = $board_number;
    $data[$_key]['board_title']      = $board_title;
    $data[$_key]['board_start_date'] = $board_start_date_text;
    $data[$_key]['board_end_date']   = $board_end_date_text;
    $data[$_key]['btn']              = implode('', $btn);
}

$set = array(
    'field' => $field,
    'data'  => $data,
);

$group .= $eZui->setGrid($set);

$body   = array();
$body[] = array('flex' => 12, 'head' => _i('公告資訊'), 'body' => $group);

$html .= $eZui->setCard(array('body' => $body));
?>
{!! $html !!}
{!! $eZui->setValidata('main') !!}
</form>
@endsection
