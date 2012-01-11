<?php
//include_once(CLASS_DIR . 'feed.class.php');

if (is_file(CLASS_DIR . 'feedmanager.class.php')) {
	include_once(CLASS_DIR . 'feedmanager.class.php');
    XT_Feedmanager::notify(XT::getConfig('baseID'), XT::getSessionValue('id'), XT::getContentType('News'));
}

?>