<?php
$html = null;

$option   = array();
$option[] = array('value' => '1', 'text' => '加簽');
$option[] = array('value' => '2', 'text' => '並簽');

$body   = array();
$body[] = array('flex' => 2, 'body' => $eZui->setRadioBox(array('head' => _('加簽方式'), 'name' => 'sign_type', 'value' => '', 'option' => $option, 'inline' => true)));
$body[] = array('flex' => 1, 'body' => $eZui->setTextBox(array('head' => _('加簽關卡'), 'name' => '', 'value' => '', 'align' => 'center')));
$body[] = array('flex' => 9, 'body' => $eZui->setJumpSel(array('head' => _('加簽人員'), 'name' => 'jump', 'value' => '', 'option' => '', 'url' => '', 'param' => array('head' => '資料選擇'))));

$html .= $eZui->setGroup(array('body' => $body));

$body = array();

switch ($status) {
    case 'add':
    case 'edit':
        $body[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'add', 'text' => '單筆加簽')));
        $body[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('icon' => 'fas fa-redo-alt', 'icon_style' => 'g', 'text' => '重整簽核')));
        break;
}

$html .= $eZui->setGroup(array('body' => $body));

$field   = array();
$field[] = array('head' => _('序'), 'name' => 'a', 'width' => '5%');
$field[] = array('head' => _('簽核資訊'), 'name' => 'b');
$field[] = array('head' => _('加簽方式'), 'name' => 'c', 'width' => '15%');

$data = array();

foreach (array() as $key => $value) {
    $a = trim($value['a']);
    $b = trim($value['b']);
    $c = trim($value['c']);

    //顯示
    $data[$key]['a'] = $a;
    $data[$key]['b'] = $b;
    $data[$key]['c'] = $c;
}

$set = array(
    'field' => $field,
    'data'  => $data,
    'btn'   => array('remove'),
);

$html .= $eZui->setGridMUL($set);
?>
{!! $html !!}
