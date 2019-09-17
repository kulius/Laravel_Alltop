<?php
$html = null;

$body   = array();
$body[] = array('body' => $eZui->setComboBox(array('head' => _i('所屬選單'), 'name' => 'menu_upper', 'value' => request()->input('menu_upper'), 'option' => $data_menu_upper, 'def' => '全部', 'attr' => array('onchange=submit();'))));

$html .= $eZui->setGroup(array('body' => $body));

$field   = array();
$field[] = array('head' => _i('功能代號'), 'name' => 'menu_number', 'width' => '10%');
$field[] = array('head' => _i('功能名稱'), 'name' => 'menu_name');
$field[] = array('head' => _i('功能狀態'), 'name' => 'menu_hide', 'width' => '8%');
$field[] = array('head' => _i('授權資訊'), 'name' => 'auth_info', 'hide' => true);

$data     = array();
$selected = array();

$auth = explode('|', $data_menu_auth[0]['auth']);

foreach ($data_menu as $_key => $_value) {
    $menu_number    = trim($_value['menu_number']);
    $menu_name      = trim($_value['menu_name']);
    $menu_hide      = trim($_value['menu_hide']);
    $menu_hide_text = ($menu_hide ? $eZui->setFont(array("text" => _i("停用"), "style" => "r")) : $eZui->setFont(array("text" => _i("啟用"), "style" => "g")));

    //顯示
    $data[$_key]['menu_number'] = $menu_number;
    $data[$_key]['menu_name']   = $menu_name;
    $data[$_key]['menu_hide']   = $menu_hide_text;

    $auth_info = array();

    if (isset($data_auth_info[$menu_number])) {
        $auth_info[] = '';

        foreach ($data_auth_info[$menu_number] as $_key_auth => $_value_auth) {
            switch ($_key_auth) {
                case 'group':
                    $auth_info[] = $eZui->setFont(array("text" => _i('群組：') . implode('、', $_value_auth), "style" => "b"));
                    break;
                case 'user':
                    $auth_info[] = $eZui->setFont(array("text" => _i('帳戶：') . implode('、', $_value_auth), "style" => "r"));
                    break;
            }
        }
    }

    $data[$_key]['auth_info'] = implode('<br>', $auth_info);

    //預設勾選
    if ($auth) {
        if (in_array($menu_number, $auth)) {
            $selected[] = $_key;
        }
    }
}

$set = array(
    'id'       => 'menu',
    'field'    => $field,
    'data'     => $data,
    'selected' => $selected,
);

$html .= $eZui->setGridMUL($set);
?>
{!! $html !!}
