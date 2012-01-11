<?php
XT::query("UPDATE " . XT::getTable("microshop_display") . " set active=1 where id=" .  XT::getValue("display_id"),__FILE__,__LINE__);
?>