<?php

// Get all users
$result = XT::query("SELECT id,username FROM " . $GLOBALS['plugin']->getTable("user") . " ORDER BY username ASC");
XT::assign("USERS", XT::getQueryData($result));

// Get all groups
$result = XT::query("SELECT id,title FROM " . $GLOBALS['plugin']->getTable("groups") . " ORDER BY title ASC");
XT::assign("GROUPS", XT::getQueryData($result));

// Get all users
$result = XT::query("SELECT id,title FROM " . $GLOBALS['plugin']->getTable("roles") . " ORDER BY title ASC");
XT::assign("ROLES", XT::getQueryData($result));

// Add buttons
XT::addButton("Save", "saveStep", "edit_step_buttons");
XT::assign("EDIT_STEP_BUTTONS", $GLOBALS['plugin']->getButtons("edit_step_buttons"));

$content = XT::build("editStep.tpl");

?>
