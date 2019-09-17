<?php
$html = null;

$field   = array();
$field[] = array('head' => _i('使用者帳號'), 'name' => 'user_number', 'width' => '10%');
$field[] = array('head' => _i('使用者名稱'), 'name' => 'user_name');

$data     = array();
$selected = array();

$auth = explode('|', $data_user_auth[0]['auth']);

foreach ($data_user as $_key => $_value) {
    //顯示
    $data[$_key]['user_number'] = trim($_value['user_number']);
    $data[$_key]['user_name']   = trim($_value['user_name']);

    //已授權
    if ($auth) {
        if (in_array($_value['user_number'], $auth)) {
            $selected[] = $_key;
        }
    }
}

$set = array(
    'id'       => 'users',
    'field'    => $field,
    'data'     => $data,
    'selected' => $selected,
);

$html .= $eZui->setGridMUL($set);
?>
{!! $html !!}
