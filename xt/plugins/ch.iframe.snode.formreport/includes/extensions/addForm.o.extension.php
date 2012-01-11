<?php

// overview Buttons
if(XT::getSessionValue('ctrl_add') || XT::getSessionValue('ctrl_cut') || XT::getSessionValue('ctrl_copy') || XT::getSessionValue('ctrl_copy_entry') || XT::getSessionValue('ctrl_cut_entry')){
	$GLOBALS['plugin']->contribute('overview_buttons','Cancel', 'ctrlCancel','cancel.png','0','master');
} else {
	$GLOBALS['plugin']->contribute('overview_buttons','Add report', 'addReport','form_add.png','0','slave1');
	$GLOBALS['plugin']->contribute('overview_buttons','Add categorie', 'addCategory','folder_new.png','0','master');
}
?>
