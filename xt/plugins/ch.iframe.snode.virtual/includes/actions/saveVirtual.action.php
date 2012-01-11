<?php
$GLOBALS['plugin']->setAdminModule('e');

$pattern = $GLOBALS['plugin']->getValue('pattern');
$url = $GLOBALS['plugin']->getValue('url');
$virtual_id = $GLOBALS['plugin']->getSessionValue('virtual_id');

$result = XT::query("SELECT 
                        COUNT(id) AS count
                   FROM 
                        " . $GLOBALS['plugin']->getTable('virtual_url') . " 
                   WHERE
                        pattern = '" . $pattern . "' AND
                        id != '" . $virtual_id . "'
                   LIMIT 1", __FILE__, __LINE__);

$data = $result->fetchRow();

if ($data['count'] == 0) {
	XT::query("UPDATE 
                " . $GLOBALS['plugin']->getTable('virtual_url') . "
           SET 
                pattern = '" . $pattern . "',
                url = '" . $url . "'
           WHERE 
                id = " . $virtual_id, __FILE__, __LINE__);
}
else {
	XT::log('This pattern allready exits', __FILE__, __LINE__, XT_ERROR);
}

?>