<?php
XT::query("UPDATE " . XT::getTable("microshop_pages") . " set active=1 where id=" .  XT::getValue("page_id"),__FILE__,__LINE__);
?>