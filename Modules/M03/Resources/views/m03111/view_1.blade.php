<?php
$html = null;

$option   = array();
$option[] = array('value' => '1', 'text' => '啟用');
$option[] = array('value' => '0', 'text' => '停用');

$body   = array();
$body[] = array('flex' => 12, 'body' => $eZui->setRadioBox(array('head' => _i('範本狀態'), 'name' => 'board_template_status', 'value' => $data_main['board_template_status'], 'option' => $option, 'inline' => true, 'req' => true)));
$body[] = array('flex' => 12, 'body' => $eZui->setComboBox(array('head' => _i('範本類別'), 'name' => 'board_class_seq', 'value' => $data_main['board_class_seq'], 'option' => $data_board_class, 'def' => '請選擇', 'req' => true, 'select' => false)));
$body[] = array('flex' => 12, 'body' => $eZui->setTextBox(array('head' => _i('範本名稱'), 'name' => 'board_template_name', 'value' => $data_main['board_template_name'], 'req' => true)));
$body[] = array('flex' => 12, 'body' => $eZui->setTextBox(array('head' => _i('範本主旨'), 'name' => 'board_template_title', 'value' => $data_main['board_template_title'], 'req' => true)));
$body[] = array('flex' => 12, 'body' => $eZui->setEditArea(array('head' => _i('範本內容'), 'name' => 'board_template_content', 'value' => $data_main['board_template_content'])));

$html .= $eZui->setGroup(array('body' => $body));
?>
{!! $html !!}
