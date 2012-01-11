<?php
$node_id  = $GLOBALS['plugin']->getValue('node_id');
$node_pid = $GLOBALS['plugin']->getValue('node_pid');
$entry_id = $GLOBALS['plugin']->getValue('entry_id');
$entry_position = $GLOBALS['plugin']->getValue('entry_position');
$value_types = $GLOBALS['plugin']->getConfig('param_types');

$sql = "SELECT
            c.id,
            c.params,
            p.package,
            p.id as pack,
            m.module,
            m.module AS modid
        FROM
            " . $GLOBALS['plugin']->getTable('plugins_packages') . " AS p,
            " . $GLOBALS['plugin']->getTable('plugins_modules') . " AS m,
            " . $GLOBALS['plugin']->getTable('navigation_contents') . " AS c
        WHERE
            p.id = c.package AND
            m.module = c.module AND
            c.lang = '" . XT::getActiveLang() . "' AND
            m.lang = 'de' AND
            m.package = c.package AND
            c.node_id = " . $node_id . " AND
            c.id =" . $entry_id ;

$result = XT::query($sql, __FILE__, __LINE__);

$row          = $result->fetchRow();
$mod_id       = $row['modid'];
$full_package = $row['package'];

$row['package'] = substr($row['package'], strrpos($row['package'],'.') + 1);
$data           = $row;
$data['params'] = array();


// Get params
preg_match_all('/[_a-zA-Z0-9]+\={1}([-+]?\d*|true|false|\"[_a-zA-Z\(.|,)\-0-9\*]+\") /',$row['params'] . " ",$params); 


$i = 0;
foreach ($params[0] as $match) {
    $name = trim(substr($match, 0, strpos($match, '=')));
    if(trim($name) != 'ncpos'){
        if (trim($name) != '') {
            $value = trim(str_replace('"', '',substr($match, strpos($match, '=') +1)));
            $data['params'][$name]['value'] = $value;
            $data['params'][$name]['allowed'] = array();
        }
    }
}

// Get  possible params
$sql = "SELECT
            pd.title,
        	p.param_name,
        	p.allowed_values,
        	p.value_type,
        	pd.description,
        	p.image,
			p.module
        FROM
        	" . $GLOBALS['plugin']->getTable('plugins_params') . " as p
        LEFT JOIN
            " . $GLOBALS['plugin']->getTable('plugins_params_details') . " as pd ON(p.package = pd.package AND p.module = pd.module AND pd.lang='de' AND p.param_name = pd.param_name )
        WHERE
        	p.module = '" . $mod_id . "' AND
        	p.package = '" . $row['pack'] . "'";


$result = XT::query($sql, __FILE__, __LINE__);

while ($row = $result->fetchRow()) {

    $entry_type = '';
    switch ($row['value_type']) {

        case $value_types['userinput']:
            $values_allowed = array();
            $default_value =  $row['allowed_values'];
            $entry_type = 'userinput';
            break;

        case $value_types['popup']:
            $values_allowed = array();
            $matches = preg_split('/[\[|\]]/', $row['allowed_values']);
            $data['params'][$row['param_name']]['tpl'] = $matches[1];
            if(is_numeric($data['params'][$row['param_name']]['value'])){
                $sresult = XT::query("SELECT title FROM xt_search_infos_global_" . $GLOBALS['plugin']->getActiveLang() ." WHERE content_id=" . $data['params'][$row['param_name']]['value'] . " AND content_type=" . $matches[3] ,__FILE__,__LINE__,0);
                while ($srow = $sresult->fetchRow()) {
                    $data['params'][$row['param_name']]['titlevalue'] = $srow['title'];
                }
            }
            $default_value =  $row['allowed_values'];
            $entry_type = 'popup';
            break;


        case $value_types['configarray']:
            $values_allowed = array();
            $package_url = explode('=>',$row['allowed_values']);
            include_once(PLUGIN_DIR . trim($package_url[0]) . '/includes/config.inc.php');
            foreach($GLOBALS['plugin']->getConfig(trim($package_url[1])) as $key => $value){
                $values_allowed[] = array('value' => "" . $key . "",'label' => trim($value)) ;

            }
            break;

        case $value_types['normal']:
            $values_allowed = array();
            foreach(explode(',', $row['allowed_values']) as $value){
                $values_allowed[] = array('value' => trim($value),'label' => trim($value)) ;

            }
            break;

        case $value_types['query']:
            $values_allowed = array();

            $values = $row['allowed_values'];
            $matches = preg_split('/[\[|\]]/', $values);

            $param_sql = $matches[1];
            $param_row = $matches[3];
            $param_title = $matches[5];

            $param_sql = str_replace('{LANG}',$GLOBALS['plugin']->getActiveLang(),$param_sql);


            $count = 0;
            if($param_sql != ''){
                $param_result = XT::query($param_sql, __FILE__, __LINE__);

                while ($param_rows = $param_result->fetchRow()) {
                    $values_allowed[$count]['value'] = $param_rows[$param_row];
                    $values_allowed[$count]['label'] = $param_rows[$param_title];
                    $count++;
                }
            }

            break;
    }



    $default_templates = array();
    $templates = array();
    $i = 0;
    foreach(glob( TEMPLATE_DIR . "/default/" .  $full_package . "/" . $row['module'] . "/*.tpl") as $template) {
        $default_templates[$i] = basename($template);
        $i++;
    }
    $i = 0;
    $themed_templates = glob(TEMPLATE_DIR . $_SESSION['theme'] .  "/" . $full_package . "/"  . $row['module'] . "/*.tpl");
    if(is_array($themed_templates)) {
        foreach($themed_templates as $template) {
            $templates[$i] = basename($template);
            $i++;
        }
    }

    $i = 0;
    $alltemplates = array_merge($default_templates,$templates);
    $i = 0;
    $usedtemplates = array();
    foreach($alltemplates as $template) {
        if (in_array($template,$templates) && !in_array($template,$usedtemplates)) {
            $template_files[$i]['theme'] = $template;
            $usedtemplates[$i] = $template;
        } else {
            if (!in_array($template,$usedtemplates)) {
                $template_files[$i]['default'] = $template;
                $usedtemplates[$i] = $template;
            }
        }
        $i++;
    }
    XT::assign("TEMPLATES",$template_files);

    $data['params'][$row['param_name']]['allowed']      = $values_allowed;
    $data['params'][$row['param_name']]['description']  = $row['description'];
    $data['params'][$row['param_name']]['image']        = $row['image'];
    $data['params'][$row['param_name']]['title']        = $row['title'];
    $data['params'][$row['param_name']]['defaultvalue'] = $default_value;
    $data['params'][$row['param_name']]['entrytype']    = $entry_type;

}

// Zonen anhand hauptconfig
if(ZONES){
    $values_allowed = array();
    foreach(explode(',', ' ,' . ZONES) as $value){
        $values_allowed[] = array('value' => trim($value),'label' => trim($value)) ;

    }
    $data['params']['plugin_zone']['allowed']      = $values_allowed;
    $data['params']['plugin_zone']['description']  = 'Select a Zone for display';
    $data['params']['plugin_zone']['title']        = 'Plugin Zone';
    $data['params']['plugin_zone']['defaultvalue'] = '';
    $data['params']['plugin_zone']['entrytype']    = 'normal';
}


XT::assign('DATA', $data);
XT::assign('NODE_ID', $node_id);
XT::assign('ENTRY_ID', $entry_id);
XT::assign('ENTRY_POSITION', $entry_position);
XT::assign('NODE_PID', $node_pid);
XT::assign('LIVETPL', XT::getValue("livetpl"));

$content = XT::build('editContent.tpl');
?>