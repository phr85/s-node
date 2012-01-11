<?php

XT::query("DELETE FROM " . XT::getTable('navigation_templates') . " WHERE tpl_id = " . XT::getValue('id') . "");
XT::query("INSERT INTO " . XT::getTable('navigation_templates') . " (tpl_id) VALUES (" . XT::getValue('id') . ")");

?>