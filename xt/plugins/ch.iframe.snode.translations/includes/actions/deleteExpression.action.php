<?php

XT::setValue('toDelete', XT::getValue('exp'));
XT::setValue('translations', array(XT::getValue('exp') => array('de' => '')));
XT::call('saveTranslation');
XT::setAdminModule('list');

?>