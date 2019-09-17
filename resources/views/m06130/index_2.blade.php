<?php
$html = null;

$body   = array();
$body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'm06130_view_custom', 'param' => array('add'))));

$html .= $eZui->setGroup(array('body' => $body));

$field   = array();
$field[] = array('head' => _('範本代號'), 'name' => 'a', 'width' => '15%');
$field[] = array('head' => _('範本名稱'), 'name' => 'b', 'width' => '50%');
$field[] = array('head' => _('功能'), 'name' => 'btn', 'align' => 'right');

$data = array();

foreach ($dataCustom as $key => $value) {
    $a = trim($value['a']);
    $b = trim($value['b']);

    $btn   = array();
    $btn[] = $eZui->setBtnHref(array('ex' => 'view', 'small' => true, 'route' => 'm06130_view_custom', 'param' => array('view', $a)));
    $btn[] = $eZui->setBtnHref(array('ex' => 'edit', 'small' => true, 'route' => 'm06130_view_custom', 'param' => array('edit', $a)));

    //顯示
    $data[$key]['a']   = $a;
    $data[$key]['b']   = $b;
    $data[$key]['btn'] = implode('', $btn);
}

$set = array(
    'id'    => 'custom',
    'field' => $field,
    'data'  => $data,
    'btn'   => array('remove'),
);

$html .= $eZui->setGridMUL($set);
?>
{!! $html !!}
