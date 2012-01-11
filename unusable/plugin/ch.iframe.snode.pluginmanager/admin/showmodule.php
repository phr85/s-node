<?
$sql = sprintf("SELECT md.module, mf.filename, mf.md5,mf.origmd5,(mf.md5 <> mf.origmd5) AS different FROM %s mf, %s md WHERE mf.module=%s AND md.id=%s",
                $GLOBALS['plugin']->getTable('modfiles'),
                $GLOBALS['plugin']->getTable('modules'),
                $GLOBALS['plugin']->getValue('id'),
                $GLOBALS['plugin']->getValue('id'));

$result = XT::query($sql,__FILE__,__LINE__);

$modfiles = array();
$i = 0;
while ($row = $result->FetchRow()) {

        if($row['different'] == 1) {
            $row['different'] = 'deactivated';
        }
        else {
            $row['different'] = 'activated';
        }

        $modfiles[$i++]= $row;

}

$GLOBALS['tpl']->assign('MODULES', $modfiles);
$content = $GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . 'module.tpl');
?>