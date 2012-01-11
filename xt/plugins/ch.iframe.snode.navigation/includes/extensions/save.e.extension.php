<?php

$GLOBALS['plugin']->contribute("edit_buttons", "[S]ave", "savePage","disk_blue.png","0","","s");
$GLOBALS['plugin']->contribute("edit_buttons", "Save and [p]review", "savePageAndPreview","view.png","0","","p");
$GLOBALS['plugin']->contribute("edit_buttons", "Simpl[e] mode", "simpleMode","nav_down_right_blue.png","0","","e");
$GLOBALS['plugin']->contribute("edit_buttons", "Edit [t]emplate", "editTemplate","pens.png","0","","t");

$GLOBALS['plugin']->contribute("contents_buttons", "Save", "savePage","disk_blue.png","0","");
$GLOBALS['plugin']->contribute("contents_buttons", "[A]dd", "addContent","add.png","0","","a");

$GLOBALS['plugin']->contribute("editcontents_buttons", "Save", "saveContent","disk_blue.png","0","","s");
$GLOBALS['plugin']->contribute("editcontents_buttons", "Save and Exit", "saveAndExitContent","disk_blue.png","0","");
$GLOBALS['plugin']->contribute("editcontents_buttons", "Add", "addContentParam","add.png","0","");
?>
