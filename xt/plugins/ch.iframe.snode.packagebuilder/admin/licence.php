<?php
foreach (glob(PLUGIN_DIR . '*') as $filename){
$plugins[] = basename($filename);
}
XT::addImageButton('[B]uild Licence','buildLicence','default','check.png', 'licence','','b');
XT::assign('PRODUCTS',$plugins);
XT::assign('VALUES',XT::getValue('value'));

$content = XT::build('licence.tpl');
?>