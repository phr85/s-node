<?php

// Set Base id
$GLOBALS['plugin']->setBaseID(3100);

// Plugin tables
$GLOBALS['plugin']->addTable('workflows','workflows','Main workflow data', false);
$GLOBALS['plugin']->addTable('workflows_phases','workflows_phases','Workflows phases', false);
$GLOBALS['plugin']->addTable('workflows_members','workflows_members','Workflows members', false);
$GLOBALS['plugin']->addTable('workflows_running','workflows_running','Running workflows', false);
$GLOBALS['plugin']->addTable('workflows_instances','workflows_instances','Workflows instances', false);
$GLOBALS['plugin']->addTable('user','user','Main users data', false);
$GLOBALS['plugin']->addTable('groups','groups','Main groups data', false);
$GLOBALS['plugin']->addTable('roles','roles','Main roles data', false);

// Plugin admin tabs
$GLOBALS['plugin']->addTab('o','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('e','Edit workflow','editWorkflow.php',false,false);

$GLOBALS['plugin']->addTab('es','Edit step','editStep.php',false,false);
$GLOBALS['plugin']->addTab('ap','Add phase','addPhase.php',false,false);
$GLOBALS['plugin']->addTab('as','Add step','addStep.php',false,false);
$GLOBALS['plugin']->addTab('asm','Add step member','addStepMember.php',false,false);

$GLOBALS['plugin']->addTabRelation('ap','e');
$GLOBALS['plugin']->addTabRelation('as','e');
$GLOBALS['plugin']->addTabRelation('asm','e');
$GLOBALS['plugin']->addTabRelation('es','e');

// Enable Permissions
$GLOBALS['plugin']->enablePermissions();
?>