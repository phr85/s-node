<?php
$ticket_id = XT::getValue('id');

// check if a file is attached and the ticket id is set
if (file_exists($_FILES['file']['tmp_name']) && is_numeric($ticket_id)) {
	// Try to create ticketing directory if not exist
	if (!is_dir(DATA_DIR . "ticketing")) {
		mkdir(DATA_DIR . "ticketing", 0755);
	}
	// Try to create the ticket folder if not exist
	if (!is_dir(DATA_DIR . "ticketing/" . $ticket_id)) {
		mkdir(DATA_DIR . "ticketing/" . $ticket_id, 0755);
	}
	// Delete an older file
	@unlink(DATA_DIR . "ticketing/" . $ticket_id . "/" . $_FILES['file']['name']);
	move_uploaded_file($_FILES['file']['tmp_name'],DATA_DIR . "ticketing/" . $ticket_id . "/" . $_FILES['file']['name']);
}
?>
