<?php

if(!XT::isLoggedIn()){
    
    XT::assign("FIELD_USERNAME", $GLOBALS['auth']->getUsernameField());
    XT::assign("FIELD_PASSWORD", $GLOBALS['auth']->getPasswordField());
    
    if(isset($_POST['username']) || isset($_POST['password'])){
        XT::assign("ERROR_MSG", $GLOBALS['lang']->msg("Login_failed"));
    }
    
    // Get Plugin Content
    $content = XT::build('default.tpl');
    
} else {
	
	// Get Plugin Content
    $content = XT::build('loggedin.tpl');
	
}

?>
