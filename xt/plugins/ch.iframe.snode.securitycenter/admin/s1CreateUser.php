<?php

// Buttons
XT::addImageButton('Save','s1addUserConfirm','default','disk_blue.png','0','slave1','s','','window.parent.frames[\'master\'].document.forms[\'usertable\'].submit();');
XT::addImageButton('Close','s1UserExit','default','exit.png','0','slave1','x','','window.parent.frames[\'master\'].document.forms[\'usertable\'].submit();');
XT::assign("BUTTONS", XT::getButtons('default'));


// Username
$data['username'] = XT::getValue('username');

// E-Mail
$data['email'] = XT::getValue('email');

// Array With groups
$result = XT::query("SELECT *
					 FROM 
					 " . XT::getTable("groups") . " 
					 ORDER BY 
					 title ASC",__FILE__,__LINE__);
$data['groups'] = array();
while($row = $result->FetchRow()){
    if (@in_array($row['id'], XT::getValue('groups'))) {
    	$row['selected'] = 1;
    }
    $data['groups'][] = $row;
}

// Array With roles
$result = XT::query("SELECT *
					 FROM 
					 " . XT::getTable("roles") . " 
					 ORDER BY 
					 title ASC",__FILE__,__LINE__);
$data['roles'] = array();
while($row = $result->FetchRow()){
    if (@in_array($row['id'], XT::getValue('roles'))) {
    	$row['selected'] = 1;
    }
    $data['roles'][] = $row;
}

XT::assign("xt" . XT::getBaseID() . "_admin", $data);

$content = XT::build('create_user.tpl');

?>
