<?php

$GLOBALS['plugin']->contribute("edit_buttons", "[S]ave", "savePageSimple","disk_blue.png","0","","s");
$GLOBALS['plugin']->contribute("edit_buttons", "Save and [p]review", "savePageSimpleAndPreview","view.png","0","","p");
$GLOBALS['plugin']->contribute("edit_buttons", "Advanced mod[e]", "advancedMode","nav_up_left_blue.png","0","","e");

$GLOBALS['plugin']->contribute("editcontents_buttons", "Save", "saveContent","disk_blue.png","0","");
$GLOBALS['plugin']->contribute("editcontents_buttons", "Save and Exit", "saveAndExitContent","disk_blue.png","0","");
$GLOBALS['plugin']->contribute("editcontents_buttons", "Add", "addContentParam","add.png","0","");
?>
