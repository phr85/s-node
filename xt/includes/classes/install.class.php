<?php
require_once(CLASS_DIR . 'zip/pclzip.lib.php');

class XT_Install {

    var $_download_server = "";
    var $_file;
    var $_archivepath;
    var $data = array();
    var $PACKAGENAME;
    var $skip_files = array();
    var $backup_files = array();

    /**
     * Install a plugin
     *
     * @param <code>plugin_id</code> Plugin ID
     * @return <code>true</code> if the plugin could be downloaded
     * @return The URL of the Package File (if curl isn't installed)
     */

    /**
     * Checks curl installation
     *
     * @return <code>true</code> cURL Library is installed
     * @return <code>false</code> cURL Library is not installed
     */
    function _isCurlInstalled(){
        if (function_exists('curl_exec')) {
            return true;
        } else {
            return false;
        }
    }

    function _getDownloadLink($plugin_id){
        return $this->_download_server . '/install/plugins/' . $plugin_id . '.zip';
    }

    function prepareFileLocal($file){
        $this->_file = array('name' => $file);
        $this->_archivepath = DATA_DIR . 'installer/repository/' . $this->_file['name'];
        $this->_extractPlugin();
        $this->_registerPlugin();
        $this->_buildAdminPages();
        $this->_buildContentType();
        $this->installSampleDataLocal($file);
    }

    function installSampleDataLocal($file){
        $this->_file = array('name' => substr($file,0,-1) . 'sd');
        $this->_archivepath = DATA_DIR . 'installer/repository/' . substr($file,0,-1) . 'sd';
        if(is_file($this->_archivepath)){
            $this->_extractPlugin();
            $this->_registerPlugin();
            $this->_buildAdminPages();
        }
    }

    function installSampleData($form_field){
        $this->_file = $_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_' . $form_field];
        $this->_archivepath = DATA_DIR . 'installer/repository/' . $this->_file['name'];

        if(move_uploaded_file($this->_file['tmp_name'], $this->_archivepath)){
            $this->_extractPlugin();
            $this->_registerPlugin();
            $this->_buildAdminPages();
            $this->_buildContentType();
        }
    }

    function installTheme($form_field){
        $this->_file = $_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_' . $form_field];
        $this->_archivepath = DATA_DIR . 'installer/repository/' . $this->_file['name'];

        if(move_uploaded_file($this->_file['tmp_name'], $this->_archivepath)){
            $this->_extractPlugin();
        }
    }

    function prepareFile($form_field){
        $this->_file = $_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_' . $form_field];
        $this->_archivepath = DATA_DIR . 'installer/repository/' . $this->_file['name'];


        if(move_uploaded_file($this->_file['tmp_name'], $this->_archivepath)){
            $this->_extractPlugin();
            $this->_registerPlugin();
            $this->_buildAdminPages();
            $this->_buildContentType();
        }
    }

    function downloadFile($url) {

    	if (!eregi('fsockopen', ini_get('disable_functions'))) {
    		$this->_file['name'] = basename($url);
    		$this->_file['name'] = str_replace("packagelist.php?package=","",$this->_file['name']);

    		$this->_archivepath = DATA_DIR . 'installer/repository/' . $this->_file['name'];
    		if(ereg(".xtp",$this->_archivepath) == false ) {
				$this->_archivepath = $this->_archivepath . ".xtp";
			}

    		if(ereg(".xtp",$this->_file['name']) == false ) {
				$this->_file['name'] = $this->_file['name'] . ".xtp";
			}


    		if (download($url,$this->_archivepath)){
    			$this->_extractPlugin();
	            $this->_registerPlugin();
	            $this->_buildAdminPages();
	            $this->_buildContentType();
    		}
    	}

    }

    // Build content types
    function _buildContentType(){

        // check for single type or multiple pages
        $ctypes = array();
        if($this->data['contenttype']['id'] != ''){
            $ctypes[0] = $this->data['contenttype'];
        }else{
            $ctypes = $this->data['contenttype'];
        }
        if(!is_array($ctypes)){
            $ctypes = array();
        }

        foreach ($ctypes as $ctypesvalue) {
            $GLOBALS['db']->query("DELETE FROM " . $GLOBALS['cfg']->get("database", "prefix") . "content_types WHERE id=" . $ctypesvalue['id'] );
            $GLOBALS['db']->query("INSERT INTO " . $GLOBALS['cfg']->get("database", "prefix") . "content_types
                 (id,
                  title,
                  open_url,
                  content_table,
                  title_field,
                  icon,
                  id_field
             ) VALUES (
                 " . $ctypesvalue['id'] . ",
                 '" . $ctypesvalue['title'] . "',
                 '" . $ctypesvalue['open_url'] . "',
                 '" . $ctypesvalue['content_table'] . "',
                 '" . $ctypesvalue['title_field'] . "',
                 '" . $ctypesvalue['icon'] . "',
                 '" . $ctypesvalue['id_field'] . "'
            )");
        }
    }

    // Build admin Pages
    function _buildAdminPages(){


        // check for single page or multiple pages
        $page = array();
        if($this->data['page']['id'] != ''){
            $page[0] = $this->data['page'];
        }else{
            $page = $this->data['page'];
        }
        if(!is_array($page)){
            $page = array();
        }
        foreach ($page as $pagevalue) {
            // check if page already exists
            $result = $GLOBALS['db']->query("SELECT count(node_id) as cnt FROM " . $GLOBALS['cfg']->get("database", "prefix") . "navigation_details WHERE node_id=" . $pagevalue['id']);
            $row=$result->fetchRow();

            if($row['cnt'] < 1 || $pagevalue['forceupdate']){
                if($pagevalue['forceupdate']){
                    $GLOBALS['db']->query("DELETE FROM " . $GLOBALS['cfg']->get("database", "prefix") . "navigation_details
                     WHERE node_id=" . $pagevalue['id'] );
                }
                if($row['cnt'] < 1){
                    // create page
                    include_once(CLASS_DIR . 'tree.class.php');
                    $tree = new XT_Tree("navigation");
                    $tree->addNodeWithID($pagevalue['parentnode'],$pagevalue['id']);
                }
                unset($lang);
                unset($langvalues);
                foreach ($pagevalue['lang'] as $lang => $langvalues) {

                    // Prepare visible value
                    if(!array_key_exists('visible',$langvalues)){
                        $langvalues['visible'] = 1;
                    }

                    // Create detail row
                    $GLOBALS['db']->query("INSERT INTO " . $GLOBALS['cfg']->get("database", "prefix") . "navigation_details
                    (
                        node_id,
                        lang,
                        tpl_file,
                        creation_user,
                        creation_date,
                        title,
                        target,
                        active,
                        live,
                        public,
                        visible,
                        ext_link,
						header,
						footer
                    ) VALUES (
                        " . $pagevalue['id'] . ",
                        '" . $lang . "',
                        '_pages/" . $langvalues['file'] . "',
                        '" . 1 . "',
                        '" . time() . "',
                        '" . $langvalues['title'] . "',
                        '_self',
                        1,
                        '" . intval($langvalues['live']) . "',
                        '" . intval($langvalues['public']) . "',
                        '" . intval($langvalues['visible']) . "',
                        '" . $langvalues['url'] . "',
						'" . $langvalues['header'] . "',
						'" . $langvalues['footer'] . "'
                    )");
                }
            }
        }
    }


    function _extractPlugin(){
        $archive = new PclZip($this->_archivepath);

        // Search all files and check if they are to skip
        foreach ($archive->listContent() as $file) {
			foreach ($this->skip_files as $skipMe) {
				if (strstr($file['filename'],$skipMe)){
					// Create a backup file if the file is to skip and memorise it
					if (is_file(ROOT_DIR . '../' . $file['filename'])) {
						if (@!copy(ROOT_DIR . '../' . $file['filename'], ROOT_DIR . '../' . $file['filename'] .'.bak')){
							XT::log("Cann't write copy " . ROOT_DIR . '../' . $file['filename'] .'.bak',__FILE__,__LINE__,XT_ERROR);
						} else {
							$copiedFiles[] = $file['filename'];
						}
					}
				}
			}
			foreach ($this->backup_files as $backup) {
				if (strstr($file['filename'],$backup)){
					// Create a backup file
					if (is_file(ROOT_DIR . '../' . $file['filename'])) {
						if (@!copy(ROOT_DIR . '../' . $file['filename'], ROOT_DIR . '../' . $file['filename'] .'.' . date("d_m_Y_Hms") . 'bak')){
							XT::log("Cann't write copy " . ROOT_DIR . '../' . $file['filename'] .'.bak',__FILE__,__LINE__,XT_ERROR);
						}
					}
				}
			}
		}


        if (@$archive->extract(
        PCLZIP_OPT_PATH, ROOT_DIR . '../',
        PCLZIP_OPT_REPLACE_NEWER,
        PCLZIP_OPT_SET_CHMOD, 0777) == 0) {
            die("Extract error : ".$archive->errorInfo(true));
        }

       // Copy back each memorised file and restore with that the original file
		if (is_array($copiedFiles)){
			foreach ($copiedFiles as $skipedFile) {
				if (is_file(ROOT_DIR . '../' . $skipedFile)) {
					if (@!copy(ROOT_DIR . '../' . $skipedFile, ROOT_DIR . '../' . $skipedFile. "NEW_" . date("d_m_Y_Hms") )){
						echo ROOT_DIR . '../' . $skipedFile;
						XT::log("Cann't write copy " . ROOT_DIR . '../' . $skipedFile . "NEW_" . date("d_m_Y_Hms") ,__FILE__,__LINE__,XT_ERROR);
					}
				}
				if (is_file(ROOT_DIR . '../' . $skipedFile .'.bak')) {
					if (@!copy(ROOT_DIR . '../' . $skipedFile .'.bak', ROOT_DIR . '../' . $skipedFile)){
						XT::log("Cann't write copy " . ROOT_DIR . '../' . $skipedFile,__FILE__,__LINE__,XT_ERROR);
					} else {
						// Delete the backup file to keep clean the system :-)
						unlink(ROOT_DIR . '../' . $skipedFile .'.bak');
					}
				}
			}
		}
    }

    function _registerPlugin(){

        require_once(CLASS_DIR . 'xml.class.php');
        $xml = new XT_XML();
        $this->PACKAGENAME = substr($this->_file['name'],0,-4);
        $folder = 'plugins';
        if(substr($this->_file['name'],-5) == '.xtsd'){
            $this->PACKAGENAME = substr($this->_file['name'],0,-5);
            $folder = 'sampledata';

        }

        if(is_file(ROOT_DIR . $folder . '/' . $this->PACKAGENAME . '/package.xml')){
            $data = XML_unserialize(file_get_contents(ROOT_DIR . $folder . '/' . $this->PACKAGENAME . '/package.xml'));
            $this->data = $data['package'];

            // Build Tables
            $tables = array();
            if($this->data['table']['id'] != ''){
                $tables[0] = $this->data['table'];
            }else{
                $tables    = $this->data['table'];
            }

            if(!is_array($tables)){
                $tables = array();
            }
            foreach($tables as $table){
                $query = str_replace("{TABLE." . $table['id'] . "}", $GLOBALS['cfg']->get("database", "prefix") . $table['id'], $table[$GLOBALS['cfg']->get("database", "type")]);
                $query = str_replace("{LANG}", 'de', $query);
                $this->_performQueries($this->_parseQuery($query));
            }

            if($folder == 'plugins'){

                // Insert into local repository
                $GLOBALS['db']->query("DELETE FROM " . $GLOBALS['cfg']->get("database", "prefix") . "plugins_packages WHERE id='" . $data['package']['baseid'] . "'");
                $GLOBALS['db']->query("DELETE FROM " . $GLOBALS['cfg']->get("database", "prefix") . "plugins_packages_details WHERE id='" . $data['package']['baseid'] . "'");

                $GLOBALS['db']->query("INSERT INTO
                        " . $GLOBALS['cfg']->get("database", "prefix") . "plugins_packages
                    (
                        id,
                        package,
                        version,
                        provider
                    ) VALUES (
                        '" . $data['package']['baseid'] . "',
                        '" . $data['package']['id'] . "',
                        " . str_replace(array('$Rev: ',' $'),'', $data['package']['version']) . ",
                        '" . $data['package']['provider'] . "'

                    )",0);

                $packagedetails = array();
                if($this->data['lang']['name'] != ''){
                    $packagedetails[0] = $this->data['lang'];
                }else{
                    $packagedetails    = $this->data['lang'];
                }
                if(!is_array($packagedetails)){
                    $packagedetails = array();
                }
                unset($lang);
                unset($langvalues);
                foreach ($packagedetails as $lang => $langvalues) {
                    $GLOBALS['db']->query("INSERT INTO
                        " . $GLOBALS['cfg']->get("database", "prefix") . "plugins_packages_details
                    (
                        id,
                        lang,
                        title,
                        description

                    ) VALUES (
                        '" . $data['package']['baseid'] . "',
                        '" . $lang . "',
                        '" . $langvalues['name'] . "',
                        '" . $langvalues['description'] . "'
                    )");
                }

            }

            // Build Contenttree
            include_once(CLASS_DIR . 'tree.class.php');
            $tree = new XT_Tree("plugins_contents");
            $contenttree = array();
            if($this->data['contenttree']['id'] != ''){
                $contenttree[0] = $this->data['contenttree'];
            }else{
                $contenttree    = $this->data['contenttree'];
            }
            if(!is_array($contenttree)){
                $contenttree = array();
            }
            foreach ($contenttree as $ctree) {

                // check if  already exists
                $result = $GLOBALS['db']->query("SELECT count(id) as cnt FROM " . $GLOBALS['cfg']->get("database", "prefix") . "plugins_contents
                WHERE id=" . $ctree['id']);
                $row=$result->fetchRow();

                if($row['cnt'] < 1){

                    $tree->addNodeWithID($ctree['parentnode'],$ctree['id']);

                    unset($lang);
                    unset($langvalues);
                    foreach ($ctree['lang'] as $lang => $langvalues) {
                        $GLOBALS['db']->query("DELETE FROM " . $GLOBALS['cfg']->get("database", "prefix") . "plugins_contents_details
                        WHERE
                            node_id = " . $ctree['id'] . "
                            AND
                            lang = '" . $lang . "'
                        ",0);
                        // Create detail row
                        $GLOBALS['db']->query("INSERT INTO " . $GLOBALS['cfg']->get("database", "prefix") . "plugins_contents_details
                        (
                            node_id,
                            lang,
                            description,
                            title
                        ) VALUES (
                            " . $ctree['id'] . ",
                            '" . $lang . "',
                            '" . $langvalues['description'] . "',
                            '" . $langvalues['title'] . "'
                        )",0);
                    }

                }
            }

            // Modules
            $module = array();
            if($this->data['module']['id'] != ''){
                $module[0] = $this->data['module'];
            }else{
                $module    = $this->data['module'];
            }
            if(!is_array($module)){
                $module = array();
            }
            foreach ($module as $mod) {
                $modulelang = array();
                if($mod['lang']['name'] != ''){
                    $modulelang[0] = $mod['lang'];
                }else{
                    $modulelang    = $mod['lang'];
                }
                unset($lang);
                unset($langvalues);
                foreach ($modulelang as $lang => $langvalues) {

                    // Delete existent modules and params
                    $GLOBALS['db']->query("DELETE FROM " . $GLOBALS['cfg']->get("database", "prefix") . "plugins_modules WHERE package='" . $data['package']['baseid'] . "' AND module='" . $mod['id'] . "' AND lang='" . $lang . "'" );
                    $GLOBALS['db']->query("DELETE FROM " . $GLOBALS['cfg']->get("database", "prefix") . "plugins_params_details WHERE package='" . $data['package']['baseid'] . "' AND module='" . $mod['id'] . "' AND lang='" . $lang . "'" );
                    $GLOBALS['db']->query("DELETE FROM " . $GLOBALS['cfg']->get("database", "prefix") . "plugins_params WHERE package='" . $data['package']['baseid'] . "' AND module='" . $mod['id'] . "'"  );


                    // insert modules
                    $GLOBALS['db']->query("INSERT INTO
                    " . $GLOBALS['cfg']->get("database", "prefix") . "plugins_modules
                    (
                    package,
                    module,
                    lang,
                    title,
                    description,
                    main_param,
                    main_content_type,
                    main_param_title
                    ) VALUES (
                    '" . $data['package']['baseid'] . "',
                    '" . $mod['id'] . "',
                    '" . $lang . "',
                    '" . $langvalues['name'] . "',
                    '" . $langvalues['description'] . "',
                    '" . $mod['main_param'] . "',
                    '" . $mod['main_content_type'] . "',
                    '" . $langvalues['main_param_title'] . "'
                    )");


                }
                $modtree = array();
                // treenodes for the module
                if(!is_array($mod['treenode'])){
                    $modtree[0] = $mod['treenode'];
                }else{
                    $modtree    = $mod['treenode'];
                }
                if(!is_array($modtree)){
                    $modtree = array();
                }
                $GLOBALS['db']->query("DELETE FROM " . $GLOBALS['cfg']->get("database", "prefix") . "plugins_contents_rel WHERE
                        package='" . $data['package']['baseid'] . "'
                    AND
                        module='" . $mod['id'] . "'
                " );
                foreach ($modtree as $tree_id) {
                    $GLOBALS['db']->query("INSERT INTO
                    " . $GLOBALS['cfg']->get("database", "prefix") . "plugins_contents_rel
                    (
                    node_id,
                    package,
                    module
                    ) VALUES (
                    " .  $tree_id . ",
                    '" . $data['package']['baseid'] . "',
                    '" . $mod['id'] . "'
                    )");
                }

                // Parameter
                $param = array();
                if($mod['param']['id'] != ''){
                    $param[0] = $mod['param'];
                }else{
                    $param = $mod['param'];
                }
                if(!is_array($param)){
                    $param = array();
                }
                foreach ($param as $parameter) {

                    // Insert Parameter
                    if($parameter['valuetype']=='sql'){
                        $parameter['values'] = str_replace("{PREFIX}", $GLOBALS['cfg']->get("database", "prefix") , $parameter['values']);

                    }
                    $GLOBALS['db']->query("INSERT INTO
                    " . $GLOBALS['cfg']->get("database", "prefix") . "plugins_params
                    (
                    package,
                    module,
                    param_name,
                    allowed_values,
                    value_type,
                    image
                    ) VALUES (
                    '" . $data['package']['baseid'] . "',
                    '" . $mod['id'] . "',
                    '" . $parameter['id'] . "',
                    '" . $parameter['values'] . "',
                    '" . $this->getValueType($parameter['valuetype']) . "',
                    '" . $parameter['image'] . "'
                    )");

                    foreach ($parameter['lang'] as $lang => $langvalues) {
                        // Insert Parameter Details
                        $GLOBALS['db']->query("INSERT INTO
                    " . $GLOBALS['cfg']->get("database", "prefix") . "plugins_params_details
                        (
                        package,
                        module,
                        param_name,
                        lang,
                        title,
                        description
                        ) VALUES (
                        '" . $data['package']['baseid'] . "',
                        '" . $mod['id'] . "',
                        '" . $parameter['id'] . "',
                        '" . $lang . "',
                        '" . $langvalues['title'] . "',
                        '" . $langvalues['description'] . "'
                        )");
                    }
                }
            }



            // single requirement
            if($data['package']['requires']['package']['id'] !=""){
                $_SESSION['installer']['requirements'][$data['package']['id']][] = $data['package']['requires']['package']['id'];
                XT::log("Package <b>" . $data['package']['requires']['package']['id'] . "</b> (Version " . $data['package']['requires']['package']['version'] . ") is required",__FILE__,__LINE__,XT_WARNING);
            }

            // Required packages
            if($data['package']['requires']['package'][0] != ''){
                foreach($data['package']['requires']['package'] as $package){
                    $_SESSION['installer']['requirements'][$data['package']['id']][] = $data['package']['requires']['package']['id'];
                    XT::log("Package " . $package['id'] . " (Version " . $package['version'] . ") is required",__FILE__,__LINE__,XT_WARNING);
                }
            }

            if(substr($this->_file['name'],-2) == 'sd' && is_file(ROOT_DIR . $folder . '/' . $this->PACKAGENAME . '/sampledata.sql')){
                $sample_data = file_get_contents(ROOT_DIR . $folder . '/' . $this->PACKAGENAME . '/sampledata.sql');
                $sample_data = str_replace("{XT_PREFIX}", $GLOBALS['cfg']->get("database", "prefix"), $sample_data);
                $sample_data = str_replace("{LANG}", 'de', $sample_data);
                $this->_performQueries($this->_parseQuery($sample_data));
            }

        } else {
            XT::log("Not a valid S-Node extension file",__FILE__,__LINE__,XT_ERROR);
        }
    }


    function getValueType($type){
        switch ($type) {
            case 'scriptfile':
            return 6;
            break;
            case 'custom':
            return 5;
            break;
            case 'popup':
            return 4;
            break;
            case 'userinput':
            return 3;
            break;
            case 'configarray':
            return 2;
            break;
            case 'sql':
            return 1;
            break;
            case 'normal':
            return 0;
            break;
            default:
            return 0;
            break;
        }
    }

    /**
     * Gets the content of the query file from the selected plugin performs
     * them on the database
     *
     * @param <code>plugin_id</code> ID of the plugin
     */
    function _prepareDatabase(){

        // Get install db script
        $contents = file_get_contents(DATA_DIR . 'installer/extracted/' . $this->PACKAGENAME . '/install.' . $GLOBALS['cfg']->get("database", "type") . '.sql');

        $tables = array();
        include_once(DATA_DIR . 'installer/extracted/' . $this->PACKAGENAME . '/tables.inc.php');

        // If there are tables
        if(is_array($tables)){
            foreach($tables as $tablename){
                $contents = str_replace("{TABLE." . $tablename . "}", $GLOBALS['cfg']->get("database", "prefix") . $tablename, $contents);
                $contents = str_replace("{LANG}", 'de', $contents);
            }
        }

        echo $contents;

        if($contents != ''){
            $queries = _parseQueryFile($contents);
            $this->_performQueries($queries);
        } else {
            // no queries to perform
        }

    }

    /**
     * Performs queries from a given array
     *
     * @param <code>queries</code> Array with single queries
     */
    function _performQueries($queries){
        foreach($queries as $query){
            $GLOBALS['db']->query($query);
        }
        XT::log("Database successfully prepared",__FILE__,__LINE__,XT_INFO);
    }

    /**
     * Parses a given string and generates an array with the single queries
     *
     * @param <code>q</code> Query File content
     * @return <code>queries</code> Array with single queries
     */
    function _parseQuery($q){

        // strip the comments from the query
        while($n=strpos($q,'--')){
            $k=@strpos($q,"\n",$n+1);
            if(!$k) $k=strlen($q);
            $q=substr($q,0,$n).substr($q,$k+1);
        }

        $n=strlen($q);
        $k=0;
        $queries=array();
        $current_delimiter='';

        for($i=0;$i<$n;$i++){
            // if this slash escapes something,
            // current delimiter must not be affected
            if($q[$i]=='\\' &&
            ($q[$i+1]=='\\' || $q[$i+1]=="'" || $q[$i+1]=='"')
            ){
                $queries[$k].=$q[$i].$q[$i+1];
                $i++;
            }
            else{

                if($q[$i]==$current_delimiter)
                $current_delimiter='';
                elseif($q[$i]=='`' || $q[$i]=="'" || $q[$i]=='"')
                $current_delimiter=$q[$i];

                if($q[$i]==';' && $current_delimiter==''){
                    $queries[$k]=trim($queries[$k]);
                    if(trim(substr($q,$i),"\r \n;")!='')
                    $k++;
                }
                else
                $queries[$k].=$q[$i];

            }
        }
        return $queries;
    }
}
?>