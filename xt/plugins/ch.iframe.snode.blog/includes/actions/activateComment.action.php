<?php
XT::loadClass('tree.class.php',"ch.iframe.snode.core");
$tree = new XT_Tree("comments");

foreach ($tree->showDelete(XT::getValue("comment_id")) as $vals) {
    XT::query("UPDATE " . XT::getTable("comments") . " set active=1 WHERE id = " . $vals['id'],__FILE__,__LINE__);
}
$GLOBALS['plugin']->setAdminModule("c");
?>