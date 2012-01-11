<?php

XT::query("DELETE from " . XT::getTable('microshop_products') . " WHERE id=" . XT::getValue("product_id") ,__FILE__,__LINE__);

?>