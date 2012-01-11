<?php
// Ensure that the data array is empty
$data = array();
$data['captcha'] = XT::getParam('captcha') == 1 ? true : false;
if(XT::getValue("pseudoaction")=='AddEntry'){
	 if ($data['captcha'] == false) {
    	XT::call('AddEntry');
    	
    	// assign errors form the action
		if (XT::getValue('gberror') != "") {
			$data['error'][] = XT::getValue('gberror');
		}
    } else {
    	if ($_SESSION['captcha_guestbook'] == md5(strtoupper($_REQUEST['captcha_guestbook']))) {
    		
    		XT::call('AddEntry');
    		
    		// assign errors form the action
			if (XT::getValue('gberror') != "") {
				$data['error'] = XT::getValue('gberror');
			}
    	} else {
    		$data['error'][] = "False captcha code";
    	}
    }
	
}

$data['name'] = XT::getValue('name');
$data['email'] = XT::getValue('email');
$data['website'] = XT::getValue('website');
$data['comment'] = XT::getValue('comment');


XT::assign("xt" . XT::getBaseID() . "_add", $data);
 
// Fetch content
if(XT::getParam("style") != ""){
    $style = XT::getParam("style");
}else{
    $style = "default.tpl";
}
$content = XT::build($style);
?>