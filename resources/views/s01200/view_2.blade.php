<?php
$html = null;

$field   = array();
$field[] = array('head' => _i('群組代號'), 'name' => 'group_number', 'width' => '15%');
$field[] = array('head' => _i('群組名稱'), 'name' => 'group_name', 'width' => '30%');
$field[] = array('head' => _i('備註'), 'name' => 'group_remark');

$data     = array();
$selected = array();

$auth = explode('|', $data_group_auth[0]['auth']);

foreach ($data_group as $_key => $_value) {
    //顯示
    $data[$_key]['group_number'] = trim($_value['group_number']);
    $data[$_key]['group_name']   = trim($_value['group_name']);
    $data[$_key]['group_remark'] = trim($_value['group_remark']);

    //已授權
    if ($auth) {
        if (in_array($_value['group_number'], $auth)) {
            $selected[] = $_key;
        }
    }
}

$set = array(
    'id'       => 'group',
    'field'    => $field,
    'data'     => $data,
    'selected' => $selected,
);

$html .= $eZui->setGridMUL($set);
?>
{!! $html !!}
