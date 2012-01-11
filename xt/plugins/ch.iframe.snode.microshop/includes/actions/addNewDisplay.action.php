<?php
// Display erstellen
XT::query("insert into " . XT::getTable("microshop_display") . " 
	( `title`, `active`, `style`, `op_title`, `currency`) values 
	( 'new display', '1', 'default.tpl', '', '€')",__FILE__,__LINE__);

$display = XT::getQueryData(XT::query("SELECT max(id) as id from " . XT::getTable("microshop_display") ,__FILE__,__LINE__));

XT::setValue('display_id',$display[0]['id']);
XT::call("addTextPage");
XT::call("addProductPage");
// shop seite locked hinzufügen
XT::query("INSERT into " . XT::getTable('microshop_pages') . " set type=2, display_id=" . $display[0]['id'] . ", position=99, active=1, locked=1" ,__FILE__,__LINE__);



?>