<?php
$displayvals = XT::getValue("display");

XT::query("UPDATE " . XT::getTable("microshop_display") . " set
title = '{$displayvals['title']}',
text_head = '" .  ($displayvals['text_head']) . "',
text_footer = '" .  ($displayvals['text_footer']) . "',
currency = '" .  ($displayvals['currency']) . "',
op_title = '" .  ($displayvals['op_title']) . "',
meta_description = '" .  ($displayvals['meta_description']) . "',
meta_keyword = '" .  ($displayvals['meta_keyword']) . "',
agb = '" .  ($displayvals['agb']) . "',
style = '{$displayvals['style']}',
image = " . XT::getValue('image') . "
WHERE id={$displayvals['id']}");
?>