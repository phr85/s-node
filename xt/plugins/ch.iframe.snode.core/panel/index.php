<?php

/**
 * this plugin only does something if the user is logged in
 */
if($GLOBALS['auth']->isAuth()){
	$content = XT::build('default.tpl');
}

?>