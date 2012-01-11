<?php

XT::query("UPDATE " . XT::getTable("poll") . " SET image = '',image_version = '', image_zoom = '' WHERE id = " . $GLOBALS['plugin']->getValue("id") . "",__FILE__,__LINE__);

XT::setAdminModule("edit");

?>