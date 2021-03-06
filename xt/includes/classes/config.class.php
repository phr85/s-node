<?php
class XT_Config {

    /**
     * configuration vars
     */
    var $_config = array();

    /**
     * available languages
     */
    var $_languages = array();

    /**
     * add a language to the system
     */
    function addLanguage($code, $language){
        $this->_languages[$code] = array();
        $this->_languages[$code]['name'] = $language;
    }

    /**
     * add a configuration section
     */
    function addSection($section_name){
        $this->_config[$section_name] = array();
        return $section_name;
    }

    /**
     * change values in config file
     */
    function changeValuesConfigFile($plugin_path, $data, $values){
        $file = fopen($plugin_path . "includes/config_settings.inc.php", "w+");
        fputs($file, "<?php\n\n/**\n * Generated by S-Node XT\n */\n\n");
        $avalueskey = array_keys($values);
        foreach($data as $key => $value){
           if(in_array($key,$avalueskey)){
               fputs($file, "\$plugin->addConfig('" . $key . "','" . $values[$key] . "','" . $value['description'] . "');\n");
           }else{
               fputs($file, "\$plugin->addConfig('" . $key . "','" . $value['value'] . "','" . $value['description'] . "');\n");
           }
        }
        fputs($file, "\n?>");
    }

    /**
     * get a configuration variable from a given section
     */
    function get($section_name, $var){
        return @$this->_config[$section_name][$var];
    }

    /**
     * get all available languages
     */
    function getLangs(){
        return $this->_languages;
    }

    /**
     * set a configuration variable in a given section
     */
    function set($section_name, $var, $value){
        $this->_config[$section_name][$var] = $value;
    }

    /**
     * write a config file
     */
    function writeConfigFile($plugin_path, $data){
        $file = fopen($plugin_path . "includes/config_settings.inc.php", "w+");
        fputs($file, "<?php\n\n/**\n * Generated by S-Node XT\n */\n\n");
        foreach($data as $key => $value){
           fputs($file, "\$plugin->addConfig('" . $key . "','" . $value['value'] . "','" . $value['description'] . "');\n");
        }
        fputs($file, "\n?>");
    }

}

?>