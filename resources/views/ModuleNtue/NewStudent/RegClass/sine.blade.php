@inject('eZui', 'App\Alltop\BaseView')

<form method='POST'>
{{ csrf_field() }}
@php
$sHtml = null;

$aBody   = array();
$aBody[] = array('body' => $eZui->setTextBox(array('head' => __('文字方塊'), 'name' => 'text', 'value' => old('text') )));
$sHtml .= $eZui->setGroup(array('body' => $aBody));

$aBody   = array();
$aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnSubmit(array('ex' => 'search')));
$aBody[] = array('flex' => 'auto', 'body' => $eZui->setBtnHref(array('ex' => 'add', 'route' => 'e00100_view', 'param' => array('add'))));
$sHtml .= $eZui->setGroup(array('body' => $aBody));

$aField   = array();
$aField[] = array('head' => __('文字方塊'), 'name' => 'text', 'width' => '15%');
$aField[] = array('head' => __('數字方塊'), 'name' => 'number', 'width' => '10%');
$aField[] = array('head' => __('郵件方塊'), 'name' => 'mail', 'width' => '20%');
$aField[] = array('head' => __('單選方塊'), 'name' => 'radio', 'width' => '10%');
$aField[] = array('head' => __('日期方塊'), 'name' => 'date', 'width' => '15%');
$aField[] = array('head' => __('日期/時間方塊'), 'name' => 'datetime', 'width' => '15%');
$aField[] = array('head' => __('功能'), 'name' => 'btn', 'align' => 'right');

$aData = array();

foreach ($data as $key => $value) {
    $sSeq    = trim($value['seq']);
    $sText   = trim($value['text']);
    $sNumber = trim($value['number']);
    $sMail   = trim($value['mail']);
    $sRadio  = $value['radio'];

    $aBtn   = array();
    $aBtn[] = $eZui->setBtnHref(array('ex' => 'view', 'small' => true, 'route' => 'e00100_view', 'param' => array('view', $sSeq)));
    $aBtn[] = $eZui->setBtnHref(array('ex' => 'edit', 'small' => true, 'route' => 'e00100_view', 'param' => array('edit', $sSeq)));

    $aData[$key]['seq']      = $sSeq;
    $aData[$key]['text']     = $sText;
    $aData[$key]['number']   = $sNumber;
    $aData[$key]['mail']     = $sMail;
    $aData[$key]['radio']    = $sRadio;
    $aData[$key]['date']     = 'BB';
    $aData[$key]['datetime'] = 'AA';
    $aData[$key]['btn']      = implode('', $aBtn);
}

$aSet = array(
    'field' => $aField,
    'data'  => $aData,
    'btn'   => array('remove', 'excel', 'pdf', 'print'),
);

$sHtml .= $eZui->setGridMUL($aSet);
dd($sHtml);
echo $sHtml;
@endphp
</form>