<?php

foreach (glob(PLUGIN_DIR . '*') as $filename){
    if(is_dir(PACKAGES . basename($filename))){
        $package_stat = stat(PACKAGES . basename($filename));
    }else {
    	$package_stat = 'not_done';
    }

    $sampledata = is_dir(ROOT_DIR . 'sampledata/' . basename($filename));
    $INSTALLED[] = array('sample_data_available' => $sampledata, 'name' => basename($filename), 'info' => stat($filename), 'package' => $package_stat );
}

XT::assign('INSTALLED',$INSTALLED);
$GLOBALS['plugin']->contribute("overview_buttons", "Synchronize", "synchronize","refresh.png","1","master");
$GLOBALS['plugin']->contribute("overview_buttons", "Build All closed", "buildAllClosed","lock.png","1","master");

$content = XT::build('overview.tpl');
?>