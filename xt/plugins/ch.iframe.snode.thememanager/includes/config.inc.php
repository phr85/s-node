<?php

XT::setBaseID(3800);

XT::addTable('plugins_packages');
XT::addTable('plugins_packages_details');
XT::addTable('plugins_modules');

XT::addTab('o','Overview','overview.php',true,true);
XT::addTab('slave1','Slave1','slave1.php',false,false);
XT::addTab('wz_ct','Create Theme','wizardCreateTheme.php',false,false);
XT::addTab('wz_st','Switch Theme','wizardSwitchTheme.php',false,false);
XT::addTab('wz_dt','Delete Theme','wizardDeleteTheme.php',false,false);
XT::addTab('wz_ex','Export Theme','wizardExportTheme.php',false,false);

XT::addTab('et','Edit template','editTemplate.php',false,false);

XT::addConfig('cmd_zip', '/usr/bin/zip', 'zip command');

XT::enablePermissions();

?>