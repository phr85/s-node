<?php

XT::query("insert into " . XT::getTable("microshop_products") . " ( `product_page_id`, `active`, `price`) values ( '" . XT::autoval("page_id") . "', '1', '0')",__FILE__,__LINE__);
?>