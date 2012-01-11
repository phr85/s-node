<?php
XT::call('saveNewsletter');

// Get the requested id
$id = XT::getValue('newsletter_id');

// Get the language of the newsletter
$result = XT::query("
	SELECT
		*
	FROM
		" . XT::getTable('newsletter') . "
	WHERE
		id = " . $id . "
",__FILE__,__LINE__);
if ($row = $result->FetchRow()) {
	$language = $row['lang'];
}

// Get all categories
$result = XT::query("
	SELECT
		*
	FROM
		" . XT::getTable('newsletter_newsl2cat') . "
	WHERE
		newsletter_id = " . $id . "
",__FILE__,__LINE__);
while ($row = $result->FetchRow()) {
	$categories[] = $row['category_id'];
}
if(is_array($categories)){
foreach($categories as $category) {

	// Get all users for each category with the language of the newsletter
	$result = XT::query("
	SELECT
		sb.id
	FROM
		" . XT::getTable('newsletter_subscr2cat') . " as cat, " . XT::getTable('newsletter_subscriptions') . " as sb
	WHERE
		cat.category_id = " . $category . " AND cat.subscription_id = sb.id AND sb.lang='" . $language . "'
	",__FILE__,__LINE__);
	while ($row = $result->FetchRow()) {
		$subresult = XT::query("
		SELECT
			count(*) as count
		FROM
			" . XT::getTable('newsletter_sent') . "
		WHERE
			newsletter_id = " . $id . " AND user_id='" . $row['id'] . "'
		",__FILE__,__LINE__);
		$srow = $subresult->FetchRow();

	    $sub2result = XT::query("
		SELECT
			count(*) as count
		FROM
			" . XT::getTable('newsletter_queue') . "
		WHERE
			newsletter_id = " . $id . " AND user_id='" . $row['id'] . "'
		",__FILE__,__LINE__);
		$srow2 = $sub2result->FetchRow();

	    if ($srow['count'] == 0 && $srow2['count'] == 0) {
			// Insert the user into the queue
			XT::query("
			INSERT INTO
				" . XT::getTable('newsletter_queue') . "
				(newsletter_id,user_id,category_id)
			VALUES
				(" . $id . "," . $row['id'] . "," . $category .")
			",__FILE__,__LINE__);
		}
	}
}
}else{
    XT::actionStop("Keine Kategorie gewählt","category");
    XT::log("Keine Kategorie gewählt",__FILE__,__LINE__,XT_ERROR);
}
$subresult = XT::query("
		UPDATE " . XT::getTable('newsletter') . "
			SET status=1, sent_date= " . time() . "
		WHERE
			id = " . $id,__FILE__,__LINE__);

?>