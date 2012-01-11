<?php

XT::setValue("username", $data[0]['email']);

// erstelle Home directory
XT::call("ch.iframe.snode.filemanager.createFolder.action.php");

// trage home beim user ein
XT::query("UPDATE " . XT::getTable("user") . " set home_node_id='" . XT::getValue("home_node_id") . "' WHERE username='" . XT::getValue("username") . "'",__FILE__,__LINE__);

?>