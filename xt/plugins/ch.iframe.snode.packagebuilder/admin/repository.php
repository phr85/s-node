<?php
$content = XT::build("overview.tpl");
foreach (glob(REPOSITORY . '*.xtp') as $filename){
    
    $INSTALLED[] = array('name' => basename($filename), 'info' => stat($filename));
}

XT::assign('INSTALLED',$INSTALLED);
$content = XT::build('overview.tpl');
?>