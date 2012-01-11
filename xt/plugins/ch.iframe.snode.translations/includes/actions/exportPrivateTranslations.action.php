<?php
$lang = XT::getValue('exportlang');
header("Content-Type: application/octet-stream");
header("Content-Disposition: inline; filename=\"" . $lang . ".lang.php\"");
echo file_get_contents(ROOT_DIR . 'includes/lang/' . $lang . '.lang.php');
exit;
?>