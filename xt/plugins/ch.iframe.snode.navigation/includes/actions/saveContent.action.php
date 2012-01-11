<?php
$GLOBALS['plugin']->setAdminModule('ec');
$paramlist = $GLOBALS['plugin']->getValue('params');
$entry_id = $GLOBALS['plugin']->getValue('entry_id');
$entry_position = $GLOBALS['plugin']->getValue('entry_position');
if($entry_id > 0){

    $result = XT::query("
        SELECT
            pm.main_param
        FROM
            " . XT::getTable('navigation_contents') . " as nc LEFT JOIN
            " . XT::getTable('plugins_modules') . " as pm ON(nc.package = pm.package AND pm.module = nc.module AND pm.lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND nc.lang = '" . $GLOBALS['plugin']->getActiveLang() . "')
        WHERE
            nc.id = " . $entry_id
    ,__FILE__,__LINE__,0);

    $main_param = '';
    while($row = $result->FetchRow()){
        $main_param = $row['main_param'];
    }

    $params = '';
    $main_value = '';
    if (is_array($paramlist)) {
        foreach ($paramlist as $name => $value) {
            if($GLOBALS['plugin']->getValue("params_" . $name)!=''){
                $value = $GLOBALS['plugin']->getValue("params_" . $name);
                if($name == $main_param){
                    $main_value = $value;
                }
            }
            if ($value != 'not_selected') {
                if (strlen($params . "$name=\"$value\"" < 256)) {
                    if(!empty($value)){
                        if(is_numeric($value) || $value=="false" || $value=="true"){
                            $params .= $name . "=" . $value . " ";
                        }else {
                            $params .= $name . "=\"" . $value . "\" ";
                        }
                    }
                }
                else {
                    XT::log('Parameter list to long', __FILE__, __LINE__, XT_WARNING);
                }
            }
        }
        $params = trim($params);
        //$params .= ' ncpos="' . $entry_position . '"';

        $sql = "UPDATE
                    " . $GLOBALS['plugin']->getTable('navigation_contents') . "
                SET
                    params = '" . $params . "',
                    main_value = '" . $main_value . "',
                    lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
                WHERE
                    id = '" . $entry_id . "'";

        XT::query($sql, __FILE__, __LINE__,0);
    }
    $GLOBALS['plugin']->call('saveTemplateContent');
} else {
    $GLOBALS['plugin']->setAdminModule('ec');
}
?>