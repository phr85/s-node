<?php
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$result = XT::query("
    SELECT
        node_id,
        title
    FROM
        " . $GLOBALS['plugin']->getTable("pools_details") . "
    WHERE
        node_id = " . $GLOBALS['plugin']->getValue("node_id") . "
    ",__FILE__,__LINE__,0);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}
XT::addImageButton('<u>S</u>ave','savePool','edit_node','disk_blue.png','0','slave1','s');
XT::addImageButton('Save and <u>E</u>xit','SavePoolAndExit','edit_node','save_close.png','0','slave1','e');
XT::addImageButton('E<u>x</u>it','exitPool','edit_node','exit.png','0','slave1','x');

XT::assign("EDIT_NODE_BUTTONS", $GLOBALS['plugin']->getButtons('edit_node'));

XT::assign("NODE_ID", $GLOBALS['plugin']->getValue("node_id"));
XT::assign("NODE", $data[0]);

$content = XT::build("editPool.tpl");
?>
