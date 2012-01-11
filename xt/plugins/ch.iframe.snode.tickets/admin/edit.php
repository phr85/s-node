<?php  
// Get all users from the system
$result = XT::query("
    SELECT
        u.*
    FROM 
        " . XT::getTable('user') . " as u,  " . XT::getTable('user_roles') . " as ur
	WHERE ur.role_id = " . XT::getConfig('admin_role') . " AND ur.user_id=u.id AND u.active=1 
    ORDER BY
       u.username ASC
", __FILE__, __LINE__);
$data['users'] = XT::getQueryData($result);

// Get all history data for a ticket
$result = XT::query("
    SELECT
        *
    FROM 
        " . XT::getTable('tickets_history') . "
	WHERE 
		ticket_id=" . XT::getValue('id') . "
    ORDER BY
       start_date ASC
", __FILE__, __LINE__);

$data['work_time'] = XT::getQueryData($result);


$data['priorities'] = XT::getConfig('priorities');

// Get ticket details
$result = XT::query("
    SELECT
        *
    FROM 
        " . XT::getTable('tickets') . "
    WHERE
     id = " . XT::getValue("id") . "
    
", __FILE__, __LINE__);
$ticket_data = XT::getQueryData($result);
$data['data'] = $ticket_data[0];

// Get all files for the ticket
$directory = DATA_DIR . "ticketing/" . XT::getValue("id");

$i = 0;
if ($handle = @opendir($directory)) {
	while (false !== ($file = readdir($handle))) {
		if (!is_dir($directory . "/" . $file)) {
			$data['files'][$i]['name'] = $file;
			$data['files'][$i]['size'] =filesize($directory . "/" . $file);
			$i++;
		}
	}
} 

if ($ticket_data[0]['supervisor'] == XT::getUserId()) {
	XT::addImageButton('Save ticket','ticketSaveSupervisor','default','save.png',0,'slave1');
	if ($ticket_data[0]['supervisor_check'] == 1 && $ticket_data[0]['checked_by_supervisor'] == 0) {
		XT::addImageButton('Mark ticket as checked','ticketChecked','default','tickets/emoticon_grin.png',0,'slave1');
	}
}elseif ($ticket_data[0]['worker'] == XT::getUserId() || $ticket_data[0]['status']  == 0) {
	XT::addImageButton('Save ticket','TicketSaveWorker','default','save.png',0,'slave1');
}

if ($ticket_data[0]['status'] == 0) {
	XT::addImageButton('Take ticket','takeTicket','default','check_small.png',0,'slave1');
}



// Assign the user id
$data['my_userid'] = XT::getUserID();
// Assign the whole data
XT::assign("xt" . XT::getBaseID() . "_admin", $data);

// Render the template
$content = XT::build('edit.tpl');
?>