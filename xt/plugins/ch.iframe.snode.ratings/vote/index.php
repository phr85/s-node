<?php 

$sessid = session_id();

// Rating given by the user
$value = $_POST['rating'];

// What kind of content is going to be rated?
$content_type = XT::autoVal("content_type","R");
$content_id = XT::autoVal("content_id","R");

// Style
$style = XT::autoval("style","P","default.tpl");

// See if user already has rated this item
$poll_id = XT::autoval("id","R");
$ip = ip2long($_SERVER['REMOTE_ADDR']);
$time = TIME - XT::getConfig('rateTime');
/*
// Did the user already vote?
$result = XT::query("
	    SELECT 
	       *
	    FROM
	        " . XT::getTable('ratings_votes') . "
	    WHERE
	        	rating_id = " . $content_id . "
	        AND
	        	iplong = " . $ip . "
	        AND
	        	c_date > " . $time . " 
	    ",__FILE__,__LINE__);

$querydata = XT::getQueryData($result);
*/

// If user is allowed to vote
if(!isset($_COOKIE["is_rated_".$content_id])) {
	
	// Insert single vote data.
	XT::query("
				INSERT INTO
	        		" . XT::getTable('ratings_votes') . "
				SET
	        		rating_id = " . $content_id . ",
	        		iplong = " . $ip . ",
	        		c_date = " . TIME . ",
	        		c_id = " . XT::getUserID() . ",
	        		sessid = '" . $sessid . "',
	        		value = " . $value,__FILE__,__LINE__,0
	        		);

	// Values in Cookie
	$cookieval = array();
	$cookieval['sessid'] = $sessid;
	$cookieval['value'] = $value;
	$cookieval['iplong'] = $ip;

	// Serialize Cookie
	$ser_cookieval = serialize($cookieval);
	
	// Set cookie + cookie values
	setcookie("is_rated_".$content_id, $ser_cookieval, TIME + XT::getConfig('rateTime'));
	
	// Check if Content has already been voted
	$result = XT::query("SELECT * FROM " . XT::getTable("ratings") . " WHERE content_id='" . $content_id . "'",__FILE__,__LINE__);
	$querydata = XT::getQueryData($result);
	
	if ($querydata[0] == ""){
		// Nothing here yet, so lets insert a new rating row
		XT::query("
				INSERT INTO
	        		" . XT::getTable('ratings') . "
				SET
	        		content_type = " . $content_type . ",
	        		content_id = " . $content_id . ",
	        		c_date = " . TIME . ",
	        		m_date = " . TIME . ",
	        		avg_total = '" . $value . "',
	        		voters_total = 1",__FILE__,__LINE__,0
	        		);		
	}else{
		$update_ratings = true;
	}
}else{
	$cookieval = array();
	$cookieval = unserialize($_COOKIE["is_rated_".$content_id]);
	print_r($cookieval);
	
	// User already voted, update old voting.
	// Get Old value
	$result = XT::query("
	    SELECT 
	       *
	    FROM
	        " . XT::getTable('ratings_votes') . "
	    WHERE
	        	rating_id = " . $content_id . "
	        AND
	        	iplong = " . $ip . "
	        AND
	        	c_date > " . $time . " 
	    ",__FILE__,__LINE__);

	$querydata = XT::getQueryData($result);
	// Update entry
	XT::query("
			UPDATE
        		" . XT::getTable('ratings_votes') . "
        	SET
        		value = " . $value . "
			WHERE
				id = " . $querydata[0]['id']. "
			",__FILE__,__LINE__,0
        		);

	$update_ratings = true;
	XT::assign("UPDATE",XT::translate('Voting updated'));
}

XT::setValue('view_result', true);

if ($update_ratings){
	// There's already a row regarding our content id. So lets just update the existing one with the new vote and the new averages!
	// Select total rating given yet
	$result = XT::query("SELECT count(total.id) as total_votes,sum(total.value) as total_values FROM " . XT::getTable('ratings_votes') . " as total WHERE total.rating_id = " . $content_id . " GROUP BY total.rating_id");
	$ratings = XT::getQueryData($result);
	
	// Anzahl Ratings
	$total_votes = $ratings[0]['total_votes'];
	// Summe aller Ratings
	$total_values =  $ratings[0]['total_values'];
	// Durchschnitt = Summe aller Ratings / Anzahl Votings. Auf 1 Nachkommastelle runden.
	
	// Division durch 0 verhindern
	if ($total_values != 0 || $total_votes != 0){
		$avg_total = $total_values / $total_votes;
	}else{
		$avg_total = $value;
	}
	
	// Update entry
	XT::query("
			UPDATE
        		" . XT::getTable('ratings') . "
        	SET
        		m_date = " . TIME . ",
        		avg_total = '" . $avg_total . "',
        		voters_total = " . $total_votes . "
			WHERE
				content_id = " . $content_id . "
			",__FILE__,__LINE__,0
        		);
}

// Select which current Value to display:
$result = XT::query("SELECT avg_total,voters_total FROM " . XT::getTable('ratings') . " WHERE content_id = " . $content_id . "");

$querydata = XT::getQueryData($result);

$data = array();
$data['curval'] = $querydata[0]['avg_total'];
$data['voters'] = $querydata[0]['voters_total'];

// Display results
XT::assign("xt" . XT::getBaseID() . "_viewer",$data);
XT::assign("xt" . XT::getBaseID() . "_rated",$value);

XT::assign("xt" . XT::getBaseID() . "_content_type",$content_type);
XT::assign("xt" . XT::getBaseID() . "_content_id",$content_id);

// build content
$content = XT::build($style);

?>