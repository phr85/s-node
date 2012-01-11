<?php

require_once(FUNC_DIR . 'basic.functions.php');

XT::setBaseID(4600);
XT::addTable('i18n_untranslated');
XT::addTable('plugins_packages');
XT::addTable('plugins_packages_details');
XT::addTab('o','Overview','overview.php',true,true);
XT::addTab('search','Search','search.php',false,true);
XT::addTab('import','Import translations','import.php',false,true);
XT::addTab('list','Translations list','list.php',false,false);
XT::addTab('et','Edit translations','editTranslations.php',false,false);
XT::addTab('slave1','Slave1','slave1.php',false,false);
XT::addTab('slave2','Slave2','slave2.php',false,false);
?>