<?php

// Add buttons
XT::addImageButton('Add newsletter','addNewsletter','default','add.png','0','slave1','a');


// Get newsletters
$result = XT::query("
    SELECT
        *
    FROM
        " . XT::getTable('newsletter') . "
    ORDER BY mod_date DESC
",__FILE__,__LINE__);

while ($row = $result->FetchRow()) {
	// Get the amount of waiting mails
	$result_queue = XT::query("
    SELECT
        count(*) as counts
    FROM
        " . XT::getTable('newsletter_queue') . "
	WHERE newsletter_id=" . $row['id'] . "
",__FILE__,__LINE__);
	$row_queue = $result_queue->FetchRow();
	$row['waiting'] = $row_queue['counts'];
	
	// Get the amount of sent mails 
	$result_sent = XT::query("
    SELECT
        count(*) as counts
    FROM
        " . XT::getTable('newsletter_sent') . "
	WHERE newsletter_id=" . $row['id'] . "
",__FILE__,__LINE__);
	$row_sent = $result_sent->FetchRow();
	$row['sent'] = $row_sent['counts'];
	
	// Get the amount of views
	$result_sent = XT::query("
    SELECT
        count(*) as counts
    FROM
        " . XT::getTable('newsletter_views') . "
	WHERE newsletter_id=" . $row['id'] . "
",__FILE__,__LINE__);
	$row_sent = $result_sent->FetchRow();
	$row['views'] = $row_sent['counts'];
	
	$data[] = $row;
}
XT::assign("NEWSLETTERS",$data);

$content = XT::build('overview.tpl');

?>
