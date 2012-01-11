<?php
// Parameter :: Style
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';
// Add the button the reset the timer. That's useful if you messed up.
XT::addImageButton('Reset timer','cleanupManager','default','recycle.png',0,'');

// If the session value isn't set try to unserialize the data from the database
// That restores the data if the browser was closed or crashed.
if (!is_array($_SESSION['timer'])) {
	// Get the data for each the current user from the database
	$result = XT::query("SELECT
       *
    FROM
        " . XT::getTable('tickets_tmp_data') . "
	WHERE 
		user_id=" . XT::getUserId() . "
    ",__FILE__,__LINE__);
	if($row = $result->fetchRow()) {
		$serialized_data = $row['serialized_data'];
		// Fill the timer array in the session with the old data
		$_SESSION['timer'] = unserialize($serialized_data);
	}
}
// Clear the data array to be sure that no other data comes from another plugin
$data = array();
// Gett all running tickets associeted with the current user
$result = XT::query("SELECT
       *
    FROM
        " . XT::getTable('tickets') . "
	WHERE 
		worker=" . XT::getUserId() . " and status=1
    ORDER BY
        date ASC
    ",__FILE__,__LINE__);
while($row = $result->fetchRow()) {
	// Set the statuschange comment
	$row['status_comment'] = XT::getValue("status_comment_" . $row['id']);
	
	// Just do something if the timer status is 1. 0 means not running, 1 is running and 2 is paused.
	if ($_SESSION['timer'][$row['id']]['status'] == 1){
		if ($_SESSION['timer'][$row['id']]['last_update'] != false){
			// If the timer is running calculate the duration since the last update and add the time to the timer
			$_SESSION['timer'][$row['id']]['time'] = $_SESSION['timer'][$row['id']]['time'] + (time() - $_SESSION['timer'][$row['id']]['last_update']);	
		}
		// Set the current time as last update
		$_SESSION['timer'][$row['id']]['last_update'] = time();
		
	}
	
	// Assign all comment to the timer. Now all comments are saved.
	$comments = XT::getValue("comment");
	if (is_array($comments)) {
		foreach($comments as $t_id=>$comment) {
			if ($row['id'] == $t_id) {
				$_SESSION['timer'][$row['id']]['comment'] = $comment;
			}
		}
	}
	
	// Assign all timer data to the row. Now we are be able to handle the timer data in the template
	$row['timer'] = $_SESSION['timer'][$row['id']];
	$data['data'][] = $row;
}

// Assign the whole data to the template.
XT::assign("xt" . XT::getBaseID() . "_manager", $data);

// Serialize all data at the end.
// With this we can easy close our browser. It doesn't matter if the browser crashes.
// It's like magic :-)
$serialized_data = serialize($_SESSION['timer']);
XT::query("
	DELETE FROM  " . XT::getTable('tickets_tmp_data') . " WHERE user_id=" . XT::getUserId() . ";
    ",__FILE__,__LINE__);
XT::query("
	INSERT INTO 
    " . XT::getTable('tickets_tmp_data') . "
	(user_id, serialized_data)
	VALUES
	(" . XT::getUserId() . ",'" . $serialized_data . "')
    ",__FILE__,__LINE__);

// Finaly build the whole content
$content = XT::build($style);
?>