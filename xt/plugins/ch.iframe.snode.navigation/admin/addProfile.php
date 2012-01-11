<?php

// Profile name
$fields['profileName']['label'] = $GLOBALS['lang']->msg("Profile name");
$fields['profileName']['size'] = 25;
$fields['profileName']['type'] = 'inputtext';
$fields['profileName']['value'] = $GLOBALS['plugin']->getPostValue("profileName");
$fields['profileName']['error'] = @$error['profileName'];

XT::assign("PROFILE", $fields);
XT::assign("LABEL_SUBMIT", $GLOBALS['lang']->msg("Add profile"));
XT::assign("LABEL_BASEDATA", $GLOBALS['lang']->msg("Profile"));

$content = XT::build('addProfile.tpl');

?>
