 @php
    $sHtml = null;
    $aBody   = array();
    $aBody[] = array('flex' => '3', 'body' => $eZui->setTextBox(array('head' => __('帳號'), 'name' => 'Account', 'value' => '', 'status' => 'view')));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setTextBox(array('head' => __('名稱'), 'name' => 'Name', 'value' => '', 'status' => 'view')));
    $aBody[] = array('flex' => '3', 'body' => $eZui->setTextBox(array('head' => __('備註'), 'name' => 'Notes', 'value' => '', 'status' => 'view')));
    $sHtml .= $eZui->setGroup(array('body' => $aBody));
    echo $sHtml;

@endphp
