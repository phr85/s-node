<?php
// the amount of newsletters
$result = XT::query("SELECT count(*) as count from " . XT::getTable("newsletter") . "",__FILE__,__LINE__);
while($row = $result->FetchRow()){
	$data['newsletters'] = $row['count'];
}
// the amount of subscribers in each category
$result = XT::query("SELECT c.id as id, c.title as name, count(*) as count 
	FROM
 	" . XT::getTable("newsletter_categories") . " as c, 
	" . XT::getTable("newsletter_subscr2cat") . " as uc, 
	" . XT::getTable("newsletter_subscriptions") . " as u 
	WHERE 
	uc.category_id = c.id AND
	uc.subscription_id = u.id
	GROUP BY c.id
	",__FILE__,__LINE__);
while($row = $result->FetchRow()){
	$data['categories'][] = $row;
}

// the amount of mails in queue
$result = XT::query("SELECT count(*) as count FROM " . XT::getTable("newsletter_queue") . "",__FILE__,__LINE__);
while($row = $result->FetchRow()){
	$data['waiting'] = $row['count'];
}
// the amount of sent mails
$result = XT::query("SELECT count(*) as count FROM " . XT::getTable("newsletter_sent") . "",__FILE__,__LINE__);
while($row = $result->FetchRow()){
	$data['sent'] = $row['count'];
}

// the amount of sent mails
$result = XT::query("SELECT count(*) as count FROM " . XT::getTable("newsletter_unsubscribed") . "",__FILE__,__LINE__);
while($row = $result->FetchRow()){
	$data['unsubscribed'] = $row['count'];
}
// Newsletter details
$result = XT::query("SELECT * from " . XT::getTable("newsletter") . " WHERE status > 0 ORDER BY sent_date DESC",__FILE__,__LINE__);
while($row = $result->FetchRow()){
	// Just count unsubscription for the last 24 hours
	$date_limit = ($row['sent_date'] - 60*60*24);
	$result_a = XT::query("SELECT count(*) as count 
	FROM
	" . XT::getTable("newsletter_newsl2cat") . " as nc, 
	" . XT::getTable("newsletter_unsubscribed") . " as u 
	WHERE 
	nc.category_id = u.category_id AND
	nc.newsletter_id = " . $row['id'] . " AND
	u.date >= " . $date_limit . " AND 
	u.date < " . $row['sent_date'] . "
	",__FILE__,__LINE__);
	if($row_a = $result_a->FetchRow()){
		$row['unsubscribed24'] = $row_a['count'];
	}
	
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
	
	
	$data['newsletter'][] = $row;
}


XT::assign("xt" . XT::getBaseId() ."_stats" , $data);
$content = XT::build('stats.tpl');
?>
