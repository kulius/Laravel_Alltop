<?php
$html = null;

$body   = array();
$body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 's01101_view', 'param' => array('add', 'main'))));

$html .= $eZui->setGroup(array('body' => $body));

$field   = array();
$field[] = array('head' => _i('選單代號'), 'name' => 'menu_number', 'width' => '10%');
$field[] = array('head' => _i('選單名稱'), 'name' => 'menu_name', 'width' => '20%');
$field[] = array('head' => _i('選單排序'), 'name' => 'menu_sort', 'width' => '10%');
$field[] = array('head' => _i('所屬專案'), 'name' => 'menu_module', 'width' => '15%');
$field[] = array('head' => _i('是否顯示'), 'name' => 'menu_hide', 'width' => '10%');
$field[] = array('head' => _i('功能'), 'name' => 'btn', 'align' => 'right');

$data = array();

foreach ($data_main as $_key => $_value) {
    $seq         = trim($_value['seq']);
    $menu_number = trim($_value['menu_number']);
    $menu_name   = trim($_value['menu_name']);
    $menu_hide   = trim($_value['menu_hide']);
    $menu_module = trim($_value['menu_module']);
    $menu_sort   = trim($_value['menu_sort']);

    $btn   = array();
    $btn[] = $eZui->setBtnHref(array('ex' => 'view', 'small' => true, 'cmd' => 'view', 'route' => 's01101_view', 'param' => array('view', 'main', $seq)));
    $btn[] = $eZui->setBtnHref(array('ex' => 'edit', 'small' => true, 'cmd' => 'edit', 'route' => 's01101_view', 'param' => array('edit', 'main', $seq)));

    $data[$_key]['seq']         = $seq;
    $data[$_key]['menu_number'] = $menu_number;
    $data[$_key]['menu_name']   = $menu_name;
    $data[$_key]['menu_module'] = $menu_module;
    $data[$_key]['menu_hide']   = $menu_hide;
    $data[$_key]['menu_sort']   = $menu_sort;
    $data[$_key]['btn']         = implode('', $btn);
}

$set = array(
    'id'    => 'main',
    'field' => $field,
    'data'  => $data,
    'btn'   => array('remove'),
);

$html .= $eZui->setGridMUL($set);
?>
{!! $html !!}
