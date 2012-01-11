<?php
if (is_array(XT::getValue('answer'))){
	$poll_id = xt::getValue('id');
	$ip = ip2long($_SERVER['REMOTE_ADDR']);
	$time = TIME - XT::getConfig('revoteTime');
	
	// Did the user already vote?
	$result = XT::query("
	    SELECT 
	       COUNT(id) AS votes
	    FROM
	        " . XT::getTable('entries') . "
	    WHERE
	        	poll_id = " . $poll_id . "
	        AND
	        	ip = " . $ip . "
	        AND
	        	date > " . $time . " 
	    ",__FILE__,__LINE__);
	
	$querydata = XT::getQueryData($result);
	
	if ($querydata[0]['votes'] == 0){
		foreach (XT::getValue('answer') as $answer_id) {			
			XT::query("
				INSERT INTO
	        		" . XT::getTable('entries') . "
				SET
	        		poll_id = " . $poll_id . ",
	        		ip = " . $ip . ",
	        		date = " . TIME . ",
	        		answer_id = " . $answer_id ,__FILE__,__LINE__,0
	        	);
		}
		
	}else{
   		XT::assign("xt" . XT::getBaseID() . "_error",XT::translate('already_voted'));
	}
}else{
	XT::assign("xt" . XT::getBaseID() . "_error",XT::translate('nothing_selected'));
}

XT::setValue('view_result', true);

?>