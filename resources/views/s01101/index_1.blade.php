<?php
$html = null;

$body   = array();
$body[] = array('body' => $eZui->setComboBox(array('head' => _i('所屬選單'), 'name' => 'menu_upper', 'value' => request()->input('menu_upper'), 'option' => $data_memu_upper, 'def' => _i('請選擇'))));

$html .= $eZui->setGroup(array('body' => $body));

$body   = array();
$body[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'search')));
$body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 's01101_view', 'param' => array('add', 'sub'))));

$html .= $eZui->setGroup(array('body' => $body));

$field   = array();
$field[] = array('head' => _i('所屬選單'), 'name' => 'menu_upper', 'width' => '10%');
$field[] = array('head' => _i('功能代號'), 'name' => 'menu_number', 'width' => '10%');
$field[] = array('head' => _i('功能排序'), 'name' => 'menu_sort', 'width' => '8%');
$field[] = array('head' => _i('功能名稱'), 'name' => 'menu_name', 'width' => '20%');
$field[] = array('head' => _i('功能狀態'), 'name' => 'menu_hide', 'width' => '8%');
$field[] = array('head' => _i('授權資訊'), 'name' => 'auth_info', 'hide' => true);
$field[] = array('head' => _i('功能'), 'name' => 'btn', 'align' => 'right');

$data = array();

foreach ($data_sub as $_key => $_value) {
    $seq            = trim($_value['seq']);
    $menu_number    = trim($_value['menu_number']);
    $menu_name      = trim($_value['menu_name']);
    $menu_hide      = $_value['menu_hide'];
    $menu_hide_text = ($menu_hide ? $eZui->setFont(array("text" => _i("停用"), "style" => "r")) : $eZui->setFont(array("text" => _i("啟用"), "style" => "g")));
    $menu_upper     = $_value['menu_upper'];
    $menu_module    = trim($_value['menu_module']);
    $menu_sort      = trim($_value['menu_sort']);

    $btn   = array();
    $btn[] = $eZui->setBtnHref(array('ex' => 'view', 'small' => true, 'cmd' => 'view', 'route' => 's01101_view', 'param' => array('view', 'sub', $seq)));
    $btn[] = $eZui->setBtnHref(array('ex' => 'edit', 'small' => true, 'cmd' => 'edit', 'route' => 's01101_view', 'param' => array('edit', 'sub', $seq)));

    $data[$_key]['seq']         = $seq;
    $data[$_key]['menu_number'] = $menu_number;
    $data[$_key]['menu_name']   = $menu_name;
    $data[$_key]['menu_upper']  = $menu_upper;
    $data[$_key]['menu_hide']   = $menu_hide_text;
    $data[$_key]['menu_sort']   = $menu_sort;

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
    $data[$_key]['btn']       = implode('', $btn);
}

$set = array(
    'id'    => 'sub',
    'field' => $field,
    'data'  => $data,
    'btn'   => array('remove'),
);

$html .= $eZui->setGridMUL($set);
?>
{!! $html !!}
