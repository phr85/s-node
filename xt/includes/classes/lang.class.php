<?php
class XT_Lang {

    var $_lang = 'de';          // Language
    var $preffered_lang = '';   // preffered language
    var $_privateMessages = array();   // Translated private messages
    var $_systemMessages = array();   // Translated private messages
    /**
     * Constructor
     **/
    function XT_Lang($language){
        if(empty($language)){
            foreach ($GLOBALS['cfg']->_languages as $key => $value) {
                $allowed_langs[$key] = $key;
            }
            $this->getLangFromBrowser($allowed_langs, $GLOBALS['cfg']->get('lang', 'default'),null,false);
        }

        if((is_file(LANG_DIR . $language . '.lang.php') && array_key_exists($language, $GLOBALS['cfg']->getLangs()))){
            $this->_lang = $language;
        }
        require_once(LANG_DIR . $this->_lang . '.lang.php');
        $this->_privateMessages = $messages[$this->_lang];
    }

    /**
     * Returns the translated expression if exists
     * 
     * @param $msg String that has to be translated
     * @return Translated expression
     */
    function msg($msg,$useLiveTranslate = false){
        if((isset($this->_privateMessages[$msg]) || isset($this->_systemMessages[$msg]))){

            if ($_COOKIE['livetranslate'] == "active" && $useLiveTranslate == true){
                if (isset($this->_privateMessages[$msg])) {
                    return stripslashes($this->displayAdvanceOptions($msg,$this->_privateMessages[$msg]));
                }elseif (isset($this->_systemMessages[$msg])) {
                    return stripslashes($this->displayAdvanceOptions($msg,$this->_systemMessages[$msg]));
                }
            }else {
                if (isset($this->_privateMessages[$msg])) {
                    return stripslashes($this->_privateMessages[$msg]);
                }elseif (isset($this->_systemMessages[$msg])) {
                    return stripslashes($this->_systemMessages[$msg]);
                }
            }


        } else {
            // TODO: write untranslated words into db, to translate and add them to the lang file
            if($msg != ''){
                if ($_COOKIE['livetranslate'] == "active" && $useLiveTranslate == true){
                    return stripslashes($this->displayAdvanceOptions($msg,$msg . '*'));

                }else {
                    return $msg . '*';
                }

            } else {
                return '';
            }
        }
    }

    function displayAdvanceOptions($Message, $Translation){
        if (XT::isLoggedIn()){
            //return '<span class="livetranslate" onclick="window.open(\'index.php?TPL=244&msg=' . $Message . '&package='. $GLOBALS['plugin']->package  .'\',\'livetranslate_' . $Message . '\',\'height=' . ((count($GLOBALS['cfg']->getLangs()) + 1) * 145)  . ',width=350,resizable=yes\')">' . $Translation . '</span>';
            return '<span class="livetranslate" onclick="window.open(\'index.php?TPL=244&msg=' . $Message . '\',\'livetranslate_' . $Message . '\',\'height=' . ((count($GLOBALS['cfg']->getLangs()) + 1) * 145)  . ',width=350,resizable=yes\')">' . $Translation . '</span>';
        }else {
            return $Message;
        }
    }

    /**
     * Get active language
     */
    function getLang(){
        return $this->_lang;
    }

    /**
     * Load plugin translations if they exist
     */
    function loadPlugin($plugin){
        $parts = explode('/', $plugin);
        if(is_file($plugin . '../includes/lang/' . $this->_lang . '.lang.php')){
            include_once($plugin . '../includes/lang/' . $this->_lang . '.lang.php');
            if(isset($plugin_messages[$this->_lang]) && is_array($plugin_messages[$this->_lang])){
                $this->_systemMessages = array_merge($this->_systemMessages, $plugin_messages[$this->_lang]);
            }
        }

        if($parts[1] != "" && is_file($plugin . '../includes/lang/' . $this->_lang . '.lang.' . $parts[2] . '.php')){
            include_once($plugin . '../includes/lang/' . $this->_lang . '.lang.' . $parts[2] . '.php');
            if(isset($module_messages[$this->_lang]) && is_array($module_messages[$this->_lang])){
                $this->_systemMessages = array_merge($this->_systemMessages, $module_messages[$this->_lang]);
            }
        }
    }
    // Browsersprache ermitteln
    // from http://aktuell.de.selfhtml.org/tippstricks/php/httpsprache/
    function getLangFromBrowser ($allowed_languages, $default_language, $lang_variable = null, $strict_mode = true) {
        // $_SERVER['HTTP_ACCEPT_LANGUAGE'] verwenden, wenn keine Sprachvariable mitgegeben wurde
        if ($lang_variable === null) {
            $lang_variable = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        }

        // wurde irgendwelche Information mitgeschickt?
        if (empty($lang_variable)) {
            // Nein? => Standardsprache zurï¿½ckgeben
            return $default_language;
        }

        // Den Header auftrennen
        $accepted_languages = preg_split('/,\s*/', $lang_variable);

        // Die Standardwerte einstellen
        $current_lang = $default_language;
        $current_q = 0;

        // Nun alle mitgegebenen Sprachen abarbeiten
        foreach ($accepted_languages as $accepted_language) {
            // Alle Infos ï¿½ber diese Sprache rausholen
            $res = preg_match ('/^([a-z]{1,8}(?:-[a-z]{1,8})*)'.
            '(?:;\s*q=(0(?:\.[0-9]{1,3})?|1(?:\.0{1,3})?))?$/i', $accepted_language, $matches);

            // war die Syntax gï¿½ltig?
            if (!$res) {
                // Nein? Dann ignorieren
                continue;
            }

            // Sprachcode holen und dann sofort in die Einzelteile trennen
            $lang_code = explode ('-', $matches[1]);

            // Wurde eine Qualitï¿½t mitgegeben?
            if (isset($matches[2])) {
                // die Qualitï¿½t benutzen
                $lang_quality = (float)$matches[2];
            } else {
                // Kompabilitï¿½tsmodus: Qualitï¿½t 1 annehmen
                $lang_quality = 1.0;
            }

            // Bis der Sprachcode leer ist...
            while (count ($lang_code)) {
                // mal sehen, ob der Sprachcode angeboten wird
                if (in_array (strtolower (join ('-', $lang_code)), $allowed_languages)) {
                    // Qualitï¿½t anschauen
                    if ($lang_quality > $current_q) {
                        // diese Sprache verwenden
                        $current_lang = strtolower (join ('-', $lang_code));
                        $current_q = $lang_quality;
                        // Hier die innere while-Schleife verlassen
                        break;
                    }
                }
                // Wenn wir im strengen Modus sind, die Sprache nicht versuchen zu minimalisieren
                if ($strict_mode) {
                    // innere While-Schleife aufbrechen
                    break;
                }
                // den rechtesten Teil des Sprachcodes abschneiden
                array_pop ($lang_code);
            }
        }

        // die gefundene Sprache setzen
        $this->preffered_lang =  $current_lang;

        // sprache im system setzen
        $this->_lang = $current_lang;
    }

    function addPrivateTranslation($message,$translation,$lang) {

        // Include the language file
        include(LANG_DIR . $lang . '.lang.php');
        $privateMessages = $messages[$lang];

        // create the header of the file
        $buffer = "<?php\n\n\$messages['" . $lang . "'] = array(\n\n";

        // Add the translation
        $privateMessages[addslashes($message)] = addslashes($translation);
        // Sort the array by keys. Looks a little bit nicer
        ksort($privateMessages);
        foreach($privateMessages as $key=>$value) {
            $buffer .= "    '" . addslashes($key) . "' => '" . addslashes($value) . "',\n";
        }
        $buffer = $buffer . ")\n\n?>";
        file_put_contents(ROOT_DIR . 'includes/lang/' . $lang . '.lang.php',$buffer);
    }

    function delPrivateTranslation($message,$lang) {

        // Include the language file
        include(LANG_DIR . $lang . '.lang.php');
        $privateMessages = $messages[$lang];

        // create the header of the file
        $buffer = "<?php\n\n\$messages['" . $lang . "'] = array(\n\n";

        // Sort the array by keys. Looks a little bit nicer
        ksort($privateMessages);
        foreach($privateMessages as $key=>$value) {
            if ($key != $message) {
                $buffer .= "    '" . addslashes($key) . "' => '" . addslashes($value) . "',\n";
            }
        }
        $buffer = $buffer . ")\n\n?>";
        file_put_contents(ROOT_DIR . 'includes/lang/' . $lang . '.lang.php',$buffer);
    }

    function getAllPrivateTranslations($lang) {
        // Include the language file
        include(LANG_DIR . $lang . '.lang.php');
        $privateMessages = $messages[$lang];
        return $privateMessages;
    }
}
?>