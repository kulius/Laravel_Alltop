<?php
$html = null;

$body   = array();
$body[] = array('flex' => 12, 'body' => $eZui->setTextBox(array('head' => _i('帳號'), 'name' => 'user_number', 'value' => $data_main['user_number'], 'req' => true)));
$body[] = array('flex' => 12, 'body' => $eZui->setPassWordBox(array('head' => _i('密碼'), 'name' => 'password', 'value' => $data_main['password'], 'req' => true)));
$body[] = array('flex' => 12, 'body' => $eZui->setTextBox(array('head' => _i('姓名'), 'name' => 'user_name', 'value' => $data_main['user_name'], 'req' => true)));

$option   = array();
$option[] = array('value' => '1', 'text' => _i('授權'));
$option[] = array('value' => '0', 'text' => _i('停權'));

$body[] = array('flex' => 6, 'body' => $eZui->setComboBox(array('head' => _i('授權狀態'), 'name' => 'authorize', 'value' => $data_main['authorize'], 'option' => $option, 'req' => true)));
$body[] = array('flex' => 6, 'body' => $eZui->setDateBox(array('head' => _i('授權到期日'), 'name' => 'eff_date', 'value' => $data_main['eff_date'])));
$body[] = array('flex' => 12, 'body' => $eZui->setTextArea(array('head' => _i('備註'), 'name' => 'remark', 'value' => $data_main['remark'])));

$html .= $eZui->setGroup(array('body' => $body));
?>
{!! $html !!}
