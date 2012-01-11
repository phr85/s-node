<?php

$GLOBALS['plugin']->call("saveValue");
header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . $GLOBALS['plugin']->getConfig("viewer_tpl") . "&x" . $GLOBALS['plugin']->getBaseID() . "_form_id=" . $GLOBALS['plugin']->getSessionValue("form_id"));

?>
