<?php
$pagevals = XT::getValue("productpage");
if($pagevals['hide_title'] == 'on'){
	$pagevals['hide_title'] = 1;
}else {
	$pagevals['hide_title'] = 0;
}

XT::query("UPDATE " . XT::getTable("microshop_productpage") . " set
site_title = '{$pagevals['site_title']}',
hide_title = {$pagevals['hide_title']},
text = '" . ($pagevals['text']) . "',
style = '{$pagevals['style']}',
image = " . XT::getValue('image') . "
WHERE id={$pagevals['id']}");



// perform CHAPTER-Articles save operation
for ($i = 0; $i <= XT::getValue('maxlevel'); $i++) {
    XT::query("
        UPDATE
            " . $GLOBALS['plugin']->getTable('microshop_products') . "
        SET
            title = '" . XT::getValue('title'. $i) . "',
            price = '" . XT::getValue('price'. $i) . "',
            text = '" . XT::getValue('text'. $i) . "',
            image = '" . XT::getValue('image'. $i) . "',
            
            give_gift_by = '" . XT::getValue('give_gift_by' . $i) . "',
            receive_items = '" . XT::getValue('receive_items' . $i) . "'
        WHERE
            id = " . XT::getValue('item_id' . $i) . "  
            
            
    ",__FILE__,__LINE__);
}

?>