<?php
switch($GLOBALS['plugin']->getValue("live_edit_mode")){
    case 'folder_title':
        include_once(CLASS_DIR . 'nestedset.class.php');
        $nestedset = new nestedset($plugin);
        $nestedset->setTable('files');
        $data = array(
            "title" => $GLOBALS['plugin']->getValue('live_edit_value')
        );
        $nestedset->updateNode($GLOBALS['plugin']->getValue('live_edit_id'), $data);
        break;

    case 'folder_desc':
        include_once(CLASS_DIR . 'nestedset.class.php');
        $nestedset = new nestedset($plugin);
        $nestedset->setTable('files');
        $data = array(
            "description" => $GLOBALS['plugin']->getValue('live_edit_value')
        );
        $nestedset->updateNode($GLOBALS['plugin']->getValue('live_edit_id'), $data);
        break;
}
?>