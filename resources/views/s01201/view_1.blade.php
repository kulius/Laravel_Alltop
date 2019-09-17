<?php
$html = null;

$body   = array();
$body[] = array('flex' => 12, 'body' => $eZui->setTextBox(array('head' => _i('群組代號'), 'name' => 'group_number', 'value' => $data['group_number'], 'req' => true)));
$body[] = array('flex' => 12, 'body' => $eZui->setTextBox(array('head' => _i('群組名稱'), 'name' => 'group_name', 'value' => $data['group_name'], 'req' => true)));
$body[] = array('flex' => 12, 'body' => $eZui->setTextArea(array('head' => _i('群組備註'), 'name' => 'group_remark', 'value' => $data['group_remark'])));

$html .= $eZui->setGroup(array('body' => $body));
?>
{!! $html !!}
