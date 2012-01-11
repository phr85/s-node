<?php
XT::loadClass('tree.class.php',"ch.iframe.snode.core");
$tree = new XT_Tree("comments");
$tree->nodeDelete(XT::getValue("comment_id"));
$GLOBALS['plugin']->setAdminModule("c");
?>