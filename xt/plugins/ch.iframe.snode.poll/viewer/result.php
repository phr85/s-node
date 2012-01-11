<?php
// id holen
$id = XT::getValue('id');

$data = array();

	 // Get Poll Title and Description
	 $result = XT::query("
		Select
			title,description,id
		FROM
            " . XT::getTable('poll') . "
		WHERE
			id = " . $id . "
		");
	 
	$temp = XT::getQueryData($result);
	$data['polltitle'] = $temp[0]['title'];
	$data['id'] = $temp[0]['id'];
	$data['description'] = $temp[0]['description'];
	
	// Select all Votes.
	$result = XT::query("
		Select
			count(e.answer_id)  as total_votes
		FROM
            " . XT::getTable('entries') . " as e
		WHERE
			e.poll_id = " . $id . "
		GROUP BY
			e.poll_id
		");
	
	// Get Total Number of Votes for All Answers 
	$temp = XT::getQueryData($result);
	$data['totalvotes'] = $temp[0]['total_votes'];

	if ($data['totalvotes'] != ""){
	// Get Votes and Answer Titles
	$result = XT::query("
		Select
			a.id,
			count(e.answer_id) as votes,
			a.title
		FROM
            " . XT::getTable('answers') . " as a
		LEFT JOIN
			xt_poll_entries as e on a.id = e.answer_id
		WHERE
			a.poll_id = " . $id . "
		GROUP BY
			a.id
		");
	 while($row = $result->FetchRow()){	
	 		$row['inpercent'] = floor($row['votes'] * 100 / $data['totalvotes']);
	 	
	 	$data['answers'][] = $row; 	
	 }
	 }else{
	 	$data['totalvotes'] = 0;
	 }
	 
	
// Assign $data...
XT::assign("xt" . XT::getBaseID() . "_viewer", $data);

// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';
$content = XT::build('result_' . $style);
?>