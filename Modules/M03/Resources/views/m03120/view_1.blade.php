<?php
$html = null;

$body   = array();
$body[] = array('flex' => 12, 'body' => $eZui->setTextBox(array('head' => _i('電子郵件（寄發測試）'), 'name' => 'mail', 'value' => '')));

$group = $eZui->setGroup(array('body' => $body));

$body   = array();
$body[] = array('flex' => 12, 'head' => _i('Mail寄發設定'), 'body' => $group);

$card = $eZui->setCard(array('body' => $body));

$body = array();

$body[] = array('flex' => 12, 'body' => $eZui->setTextBox(array('head' => _i('公告代碼'), 'value' => $data_main['board_number'], 'status' => 'view')));
$body[] = array('flex' => 4, 'body' => $eZui->setTextBox(array('head' => _i('發佈人員'), 'value' => $data_main['ins_user_number'], 'status' => 'view')));
$body[] = array('flex' => 4, 'body' => $eZui->setTextBox(array('head' => _i('發佈單位'), 'value' => $data_main['ins_user_unit'], 'status' => 'view')));
$body[] = array('flex' => 4, 'body' => $eZui->setTextBox(array('head' => _i('發佈時間'), 'value' => $data_main['ins_datetime'], 'status' => 'view')));

$option   = array();
$option[] = array('value' => 'a', 'text' => _i('公佈欄'));
$option[] = array('value' => 'b', 'text' => _i('公告'));
$option[] = array('value' => 'c', 'text' => _i('MAIL'));
$option[] = array('value' => 'd', 'text' => _i('公告及MAIL'));

$body[] = array('flex' => 12, 'body' => $eZui->setRadioBox(array('head' => _i('公告類型'), 'name' => 'board_type', 'value' => $data_main['board_type'], 'option' => $option, 'attr' => array('onclick=setMail();'), 'inline' => true, 'req' => true)));
$body[] = array('flex' => 12, 'body' => $card, 'attr' => array('id="mail_set"', 'style="display:none"', 'onclick=alert("S");'));
$body[] = array('flex' => 12, 'body' => $eZui->setJump(array('text' => '公告範本選擇', 'style' => 'i', 'url' => 'm03120_jump', 'param' => array('head' => '公告範本選擇'))));
$body[] = array('flex' => 12, 'body' => $eZui->setTextBox(array('head' => _i('公告主旨'), 'name' => 'board_title', 'value' => $data_main['board_title'], 'req' => true)));
$body[] = array('flex' => 6, 'body' => $eZui->setDateBox(array('head' => _i('開始日期'), 'name' => 'board_start_date', 'value' => $data_main['board_start_date'])));
$body[] = array('flex' => 6, 'body' => $eZui->setDateBox(array('head' => _i('結束日期'), 'name' => 'board_end_date', 'value' => $data_main['board_end_date'])));

/*
$option   = array();
$option[] = array('value' => '1', 'text' => _i('已公布'));
$option[] = array('value' => '0', 'text' => _i('暫存'));
$option[] = array('value' => '-1', 'text' => _i('下架'));

$body[] = array('flex' => 12, 'body' => $eZui->setRadioBox(array('head' => _i('公告狀態'), 'name' => 'board_status', 'value' => $data_main['board_status'], 'option' => $option, 'inline' => true, 'status' => 'view')));
 */

$body[] = array('flex' => 12, 'body' => $eZui->setEditArea(array('head' => _i('公告內容'), 'name' => 'board_content', 'value' => $data_main['board_content'])));

$group = $eZui->setGroup(array('body' => $body));

$body   = array();
$body[] = array('flex' => 12, 'body' => $eZui->setFileBoxMUL(array("head" => _i('公告附件'), 'name' => 'board_file', 'data' => $data_file)));

$group_file = $eZui->setGroup(array("body" => $body));

$body   = array();
$body[] = array('flex' => 12, 'body' => $group);
$body[] = array('flex' => 12, 'body' => $group_file);

$html .= $eZui->setCard(array('body' => $body));
?>
{!! $html !!}
