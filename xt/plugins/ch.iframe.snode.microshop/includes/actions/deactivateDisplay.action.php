<?php
XT::query("UPDATE " . XT::getTable("microshop_display") . " set active=0 where id=" .  XT::getValue("display_id"),__FILE__,__LINE__);
?>