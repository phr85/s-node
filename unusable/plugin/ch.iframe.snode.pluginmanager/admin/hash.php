<?php
$plugin_dir = $GLOBALS['plugin']->getConfig('plugin_dir');
$sql = sprintf("SELECT id, filename, origmd5 FROM %s", $GLOBALS['plugin']->getTable('modfiles'));

$result = XT::query($sql,__FILE__,__LINE__);

while ($row = $result->FetchRow()) {
    if(is_readable($plugin_dir . $row['filename'])) {
        $md5 = md5_file($plugin_dir . $row['filename']);

        if($row['origmd5'] != $md5) {
            $sql_update = sprintf("UPDATE %s SET md5='%s' WHERE id=%s", $GLOBALS['plugin']->getTable('modfiles'), $md5, $row['id']);

            $result_update = XT::query($sql_update,__FILE__,__LINE__);
        }
    }
}
?>