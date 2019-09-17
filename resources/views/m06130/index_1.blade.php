<?php
$html = null;

$body   = array();
$body[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'm06130_view', 'param' => array('add'))));

$html .= $eZui->setGroup(array('body' => $body));

$field   = array();
$field[] = array('head' => _('對應表單'), 'name' => 'a', 'width' => '15%');
$field[] = array('head' => _('範本代號'), 'name' => 'b', 'width' => '15%');
$field[] = array('head' => _('範本名稱'), 'name' => 'c', 'width' => '30%');
$field[] = array('head' => _('功能'), 'name' => 'btn', 'align' => 'right');

$data = array();

foreach ($dataForm as $key => $value) {
    $a = trim($value['a']);
    $b = trim($value['b']);
    $c = trim($value['c']);

    $btn   = array();
    $btn[] = $eZui->setBtnHref(array('ex' => 'view', 'small' => true, 'route' => 'm06130_view', 'param' => array('view', $b)));
    $btn[] = $eZui->setBtnHref(array('ex' => 'edit', 'small' => true, 'route' => 'm06130_view', 'param' => array('edit', $b)));

    //顯示
    $data[$key]['a'] = $a;
    $data[$key]['b'] = $b;
    $data[$key]['c'] = $c;

    $data[$key]['btn'] = implode('', $btn);
}

$set = array(
    'id'    => 'form',
    'field' => $field,
    'data'  => $data,
    'btn'   => array('remove'),
);

$html .= $eZui->setGridMUL($set);
?>
{!! $html !!}
