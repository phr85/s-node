	<?php

XT::setAdminModule('et');

foreach(XT::getValue('translations') as $exp => $translations){
    
    foreach($translations as $lang => $translation){
        if(XT::getSessionValue('package_id') == 'global'){
            $buffer = "<?php\n\n\$messages['" . $lang . "'] = array(\n\n";
        } else {
            $buffer = "<?php\n\n\$plugin_messages['" . $lang . "'] = array(\n\n";
        }
        
        if(XT::getSessionValue('package_id') == 'global'){
            if(!is_file(ROOT_DIR . 'includes/lang/' . $lang . '.lang.php')){    
                file_put_contents(ROOT_DIR . 'includes/lang/' . $lang . '.lang.php','');
            }
            include(ROOT_DIR . 'includes/lang/' . $lang . '.lang.php');
            $plugin_messages[$lang] = $messages[$lang];
        } else {
            if(!is_file(PLUGIN_DIR . XT::getSessionValue('package_id') . '/includes/lang/' . $lang . '.lang.php')){    
                file_put_contents(PLUGIN_DIR . XT::getSessionValue('package_id') . '/includes/lang/' . $lang . '.lang.php','');
            }
            include(PLUGIN_DIR . XT::getSessionValue('package_id') . '/includes/lang/' . $lang . '.lang.php');
        }

        if(is_array($plugin_messages[$lang])){
            if(!isset($plugin_messages[$lang][stripslashes($exp)])){
                 $plugin_messages[$lang][stripslashes($exp)] = $translation;
            }
            
            ksort($plugin_messages[$lang]);
            foreach($plugin_messages[$lang] as $expression => $trans){
                
                $expression =addslashes($expression);
                if($expression == $exp){
                    $trans = $translation;
                    $expression = XT::getValue('new_exp');
                }
                if($expression != XT::getValue('toDelete') && $trans != ""){
                    $buffer .= "    '" . addslashes(stripslashes($expression)) . "' => '" . addslashes(stripslashes($trans)) . "',\n";
                }
            }
        } else {
            if($exp != ''){
              $buffer .= "    '" . addslashes($exp) . "' => '" . addslashes($translation) . "',\n";
            }
        }
        
        $buffer = $buffer . ");\n\n?>";

         
        if(XT::getSessionValue('package_id') == 'global'){
            file_put_contents(ROOT_DIR . 'includes/lang/' . $lang . '.lang.php',$buffer);        
        } else {
            file_put_contents(PLUGIN_DIR . XT::getSessionValue('package_id') . '/includes/lang/' . $lang . '.lang.php',$buffer);        
        }
         
         
    }
}

?>