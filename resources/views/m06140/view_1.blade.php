<?php
$html = null;

$option   = array();
$option[] = array('value' => '1', 'text' => '場地租借');
$option[] = array('value' => '2', 'text' => '採購單');

$body   = array();
$body[] = array('flex' => 6, 'body' => $eZui->setTextBox(array('head' => _('申請人員'), 'name' => '', 'value' => '系統管理者', 'status' => 'view')));
$body[] = array('flex' => 6, 'body' => $eZui->setTextBox(array('head' => _('申請日期'), 'name' => '', 'value' => '系統管理者', 'status' => 'view')));
$body[] = array('flex' => 12, 'body' => $eZui->setComboBox(array('head' => _('表單範本'), 'name' => '', 'value' => '', 'def' => '請選擇', 'option' => $option)));
$body[] = array('flex' => 12, 'body' => $eZui->setTextBox(array('head' => _('表單主旨'), 'name' => '', 'value' => '', 'req' => true)));
$body[] = array('flex' => 12, 'body' => $eZui->setTextArea(array('head' => _('表單內容'), 'name' => '', 'value' => '', 'req' => true)));

$html .= $eZui->setGroup(array('body' => $body));
?>
{!! $html !!}
