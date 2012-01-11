<?php

XT::query("DELETE FROM " . XT::getTable("poll") . " WHERE id = " . XT::getValue("id") . "",__FILE__,__LINE__);
XT::query("DELETE FROM " . XT::getTable("answers") . " WHERE poll_id = " . XT::getValue("id") . "",__FILE__,__LINE__);
XT::query("DELETE FROM " . XT::getTable("entries") . " WHERE poll_id = " . XT::getValue("id") . "",__FILE__,__LINE__);


XT::setAdminModule("overview");

?>