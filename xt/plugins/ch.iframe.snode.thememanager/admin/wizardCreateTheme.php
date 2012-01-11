<?php

include_once(INCLUDE_DIR . 'doctypes.inc.php');
XT::assign("DOCTYPES", $doctypes);

$content = XT::build('wizardCreateTheme.tpl');

?>