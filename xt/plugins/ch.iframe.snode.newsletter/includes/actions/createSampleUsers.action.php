<?php
$testcategory = XT::getValue("testcategory");
// Add test useres for aa@trah-mail.com, ab@trah-mail.com, ac@trah-mail.com, ... zz@trah-mail.com
for ($i=65;$i<91;$i++)
  {
    $first_char = chr($i);
    for ($h=65;$h<91;$h++) {
    	$second_char = chr($h);
    	// create the mail address
    	$email = $first_char . $second_char . "@trash-mail.com";
    	echo $email;
    	// Insert the thest subscription
    	XT::query("
	    INSERT INTO
	        " . XT::getTable("newsletter_subscriptions") . "
	    (
	        creation_date,
	        creation_user,
	        lang,
			name,
			email
	    ) VALUES (
	        " . time() . ",
	        " . XT::getUserID() . ",
	        '" . $GLOBALS['cfg']->get('lang','default') . "',
			'" . $email. "',
			'" . $email. "'
	    )
		",__FILE__,__LINE__);
		// Get the id of the new subscription
		$result = XT::query("SELECT id FROM " . XT::getTable("newsletter_subscriptions") . " WHERE email='" . $email . "'",__FILE__,__LINE__);
		$row = $result->fetchRow();
		$id = $row['id'];
		XT::query("
	    INSERT INTO
	        " . XT::getTable("newsletter_subscr2cat") . "
	    (
	        category_id,
	        subscription_id
	    ) VALUES (
			" . $testcategory. ",
			" . $id. "
	    )
		",__FILE__,__LINE__);
    }
  }




?>