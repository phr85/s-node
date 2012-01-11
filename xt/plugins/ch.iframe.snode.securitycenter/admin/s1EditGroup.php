<?php  
// execute query and check for errors
$result = XT::query("SELECT id,title,description,active,creation_date,creation_user,mod_date,mod_user
 FROM " . $GLOBALS['plugin']->getTable("groups") . " WHERE id = " . $GLOBALS['plugin']->getValue("group_id") . "",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("GROUP", $data[0]);
XT::assign("GROUP_ID", $data[0]['id']);
XT::assign("PRINCIPAL_ID", $data[0]['id']);

// Buttons
XT::addImageButton('<u>S</u>ave','s1SaveGroup','default','disk_blue.png','0','slave1','s');
XT::addImageButton('Save and <u>E</u>xit','s1SaveGroupAndExit','default','save_close.png','0','slave1','e');
XT::addImageButton('E<u>x</u>it','s1GroupExit','default','exit.png','0','slave1','x');


$content = XT::build('s1EditGroup.tpl');

?>