<?php

// orderhistory löschen
XT::query("DELETE from " . XT::getTable("microshop_order_history") . " where display_id=" . XT::getValue("display_id"),__FILE__,__LINE__);
// producte löschen
$res = XT::query("SELECT id from " . XT::getTable("microshop_productpage") . " where display_id=" . XT::getValue("display_id") ,__FILE__,__LINE__);

while($row = $res->FetchRow()){
     XT::query("DELETE from " . XT::getTable("microshop_products") . " where product_page_id=" . $row['id'] ,__FILE__,__LINE__);
}

// produktseiten löschen
XT::query("DELETE from " . XT::getTable("microshop_productpage") . " where display_id=" . XT::getValue("display_id"),__FILE__,__LINE__);
// textseiten löschen
XT::query("DELETE from " . XT::getTable("microshop_textpage") . " where display_id=" . XT::getValue("display_id"),__FILE__,__LINE__);
// pages löschen
XT::query("DELETE from " . XT::getTable("microshop_pages") . " where display_id=" . XT::getValue("display_id"),__FILE__,__LINE__);
// display löschen
XT::query("DELETE from " . XT::getTable("microshop_display") . " where id=" . XT::getValue("display_id"),__FILE__,__LINE__);
?>