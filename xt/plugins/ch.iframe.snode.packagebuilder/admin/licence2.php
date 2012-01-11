<?php

XT::addImageButton('[B]uild Licence','buildLicence2','default','check.png', 'licence','','b');

XT::assign('PRODUCTS',array("micro","beginner","medium","standard","enterprise","all"));

XT::assign('VALUES',XT::getValue('value'));

  
$content = XT::build('licence2.tpl');
?>