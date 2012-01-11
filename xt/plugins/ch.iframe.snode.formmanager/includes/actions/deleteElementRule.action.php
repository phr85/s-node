<?php

XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("forms_elements_rules") . " WHERE id = " . $GLOBALS['plugin']->getValue("rule_id"),__FILE__,__LINE__);

?>
