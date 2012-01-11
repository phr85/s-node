<?php
XT::query("UPDATE " . XT::getTable("microshop_products") . " set active=1 where id=" .  XT::getValue("product_id"),__FILE__,__LINE__);
?>