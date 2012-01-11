<?php

if($_POST['system_name'] != ''){
    $_SESSION['config']['system']['name'] = $_POST['system_name']; 
}
if($_POST['system_order_nr'] != ''){
    $_SESSION['config']['system']['order_nr'] = $_POST['system_order_nr']; 
} else {
	// Take default order number for localhost if no order number is given.
	$_SESSION['config']['system']['order_nr'] = 555; 
}
if($_POST['system_email'] != ''){
    $_SESSION['config']['system']['email'] = $_POST['system_email']; 
}
if($_POST['system_meta_title'] != ''){
    $_SESSION['config']['system']['title'] = $_POST['system_meta_title']; 
}
if($_POST['system_meta_description'] != ''){
    $_SESSION['config']['system']['description'] = $_POST['system_meta_description']; 
}
if($_POST['system_meta_keywords'] != ''){
    $_SESSION['config']['system']['keywords'] = $_POST['system_meta_keywords']; 
}
if($_POST['system_meta_copyright'] != ''){
    $_SESSION['config']['system']['copyright'] = $_POST['system_meta_copyright']; 
}
if($_POST['system_meta_author'] != ''){
    $_SESSION['config']['system']['author'] = $_POST['system_meta_author']; 
}
if($_POST['webroot_dir'] != ''){
    $_SESSION['config']['system']['webroot_dir'] = $_POST['webroot_dir']; 
}
if($_POST['system_meta_revisit_after'] != ''){
    $_SESSION['config']['system']['revisit_after'] = $_POST['system_meta_revisit_after']; 
}
if($_POST['system_piwik_id'] != ''){
    $_SESSION['config']['system']['piwik_id'] = $_POST['system_piwik_id']; 
}
if($_POST['system_google_analytics_key'] != ''){
    $_SESSION['config']['system']['google_analytics_key'] = $_POST['system_google_analytics_key']; 
}
if($_POST['system_google_maps_key'] != ''){
    $_SESSION['config']['system']['google_maps_key'] = $_POST['system_google_maps_key']; 
}

// Mailserver
if($_POST['smtp_Host'] != ''){
    $_SESSION['config']['smtp']['Host'] = $_POST['smtp_Host']; 
}

$d = dir(getcwd() . '/xt/data/installer/repository');
$packages = array();
$third_party_packages = array();
while (false !== ($entry = $d->read())) {
    if(substr($entry,-4) == '.xtp'){
        if(substr($entry,0,15) == 'ch.iframe.snode'){
            $packages[] = $entry;
        } else {
            $third_party_packages[] = $entry;
        }
    }
}
$d->close();

$tpl->assign("PACKAGES", $packages);
$tpl->assign("3RD_PACKAGES", $third_party_packages);

$tpl->display('4.tpl');

?>