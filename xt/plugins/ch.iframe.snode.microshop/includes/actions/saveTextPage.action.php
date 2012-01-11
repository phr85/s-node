<?php
$pagevals = XT::getValue("textpage");
if($pagevals['hide_title'] == 'on'){
	$pagevals['hide_title'] = 1;
}else {
	$pagevals['hide_title'] = 0;
}

XT::query("UPDATE " . XT::getTable("microshop_textpage") . " set
site_title = '{$pagevals['site_title']}',
hide_title = {$pagevals['hide_title']},
text = '" . ($pagevals['text']) . "',
style = '{$pagevals['style']}',
image = " . XT::getValue('image') . "
WHERE id={$pagevals['id']}");

?>