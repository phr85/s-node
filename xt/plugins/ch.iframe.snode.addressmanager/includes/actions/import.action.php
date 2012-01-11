<?php
@set_time_limit(0);
include(PLUGIN_DIR . 'ch.iframe.snode.addressmanager/includes/importer.config.inc.php');
$uploadhandler = $_FILES['x' . XT::getBaseID() . '_file'];

// haben wir die Datei bekommen?
$file_is_ok = false;
switch ($uploadhandler['error']) {
    case 0:
        $file_is_ok = true;
        break;
    case 1:
        XT::log('file is to big (php.ini)',__FILE__,__LINE__,XT_ERROR);
        $file_is_ok = false;
        break;
    case 2:
        // MAX_FILE_SIZE
        XT::log('file is to big',__FILE__,__LINE__,XT_ERROR);
        $file_is_ok = false;
        break;
    case 3:
        XT::log('upload failed, missing parts',__FILE__,__LINE__,XT_ERROR);
        $file_is_ok = false;
        break;
    case 4:
        XT::log('no file uploaded',__FILE__,__LINE__,XT_ERROR);
        $file_is_ok = false;
        break;
}

if($file_is_ok){
    XT::loadClass('csv.class.php','ch.iframe.snode.core');
    $csv = new csv($uploadhandler['tmp_name']);
    $csv->fieldSeperator = $addrimportcfg['delimiter'];
    $csv->fieldEncloserChar = $addrimportcfg['enclosure'];
    $csv->fieldEscapeChar = $addrimportcfg['escape_character'];

    $csv->read();
    XT::loadClass('address.class.php','ch.iframe.snode.addressmanager');

    if($addrimportcfg['ignore_first_line']){
        array_shift($csv->data);
    }

    foreach ($csv->data as $csv_address) {
        if(count($csv_address) <= $addrimportcfg['max_num_of_coulumn_in_source_file']){

            // Neue Adresse anlegen wenn anhand identifier keine id kommt
            if(is_array($addrimportcfg['identifier_coulumn'])) {
                $identifierstring = "";
                foreach($addrimportcfg['identifier_coulumn'] as $fieldkey) {
                    if($csv_address[$fieldkey] != "") {
                        $identifierstring .= $csv_address[$fieldkey];
                    }
                }
                $identifierstring = md5($identifierstring);
                $address = new XT_Address(XT_Address::get_address_id_by_identifier($identifierstring));
            }
            elseif(is_int($addrimportcfg['identifier_coulumn']) && $csv_address[$addrimportcfg['identifier_coulumn']] != "") {
                $address = new XT_Address(XT_Address::get_address_id_by_identifier($csv_address[$addrimportcfg['identifier_coulumn']]));
            }
            elseif(is_int($addrimportcfg['snode_identifier_coulumn']) && is_int($csv_address[$addrimportcfg['snode_identifier_coulumn']])) {
                $address = new XT_Address($csv_address[$addrimportcfg['snode_identifier_coulumn']]);
            }
            else {
                $address = new XT_Address();
            }
            
            $address->save();
            $address_id = $address->getID();
            $address = new XT_Address($address_id);

            if(is_array($addrimportcfg['identifier_coulumn']) && $identifierstring) {
                $address->setIdentifier($identifierstring);
            }
            if(is_int($addrimportcfg['identifier_coulumn']) && $csv_address[$addrimportcfg['identifier_coulumn']] != ""){
                $address->setIdentifier($csv_address[$addrimportcfg['identifier_coulumn']]);
            }

            // parse data
            foreach ($addrimportcfg['data'] as $type => $field) {
                unset($addrval);
                unset($not_overwrite);
                if($field['enabled']){
                    if($field['callback']){
                        $dataarray['field'] =  $field['coulumn'];
                        $dataarray['data'] =  $csv_address;
                        $dataarray['id'] =  $address->getID();
                        $addrval = call_user_func($field['callback'],$dataarray);
                    }else {
                        if($csv_address[$field['coulumn']]){
                            $addrval = $csv_address[$field['coulumn']];
                        }else {
                            if($field['default_value']){
                                $addrval = $field['default_value'];
                            }
                        }
                    }
                    if($field['not_overwrite']) {
                        $not_overwrite['type'] = str_replace("set","get", $type);
                        $not_overwrite['value'] = $address->$not_overwrite['type']();
                        if(empty($not_overwrite['value'] )) {
                            $address->$type(addslashes($addrval));
                        }
                    }
                    else {
                        $address->$type(addslashes($addrval));
                    }
                }else {
                    if($field['use_default_value_if_disabled']){
                        $address->$type(addslashes($field['default_value']));
                    }
                }
            }
            
            // Get coordinates
            if($GLOBALS['cfg']->get("system","google_map_key") != "" &&
               $address->getStreet() != "" &&
               $address->getPostalCode() != "" &&
               $address->getCity() != "" &&
               $address->getCountry() != "") {
                
                XT::loadClass('coordinates.class.php','ch.iframe.snode.addressmanager');
                $coordinates = new coordinates($GLOBALS['cfg']->get("system","google_map_key"));
                $coordinates->set("street", $address->getStreet());
                $coordinates->set("postal_code", $address->getPostalCode());
                $coordinates->set("city", $address->getCity());
                $coordinates->set("country", $address->getCountry());
                
                if($coordinates_array = $coordinates->query()) {
                    $address->setLatitude($coordinates_array['lat']);
                    $address->setLongitude($coordinates_array['lon']);
                }
            }
            
            // Speichern
            $address->save();
            $address_ids[] = $address->getID();
        }else {
            XT::log("source have more coulums then defined in max_num_of_coulumn_in_source_file",__FILE__,__LINE__,XT_ERROR);
            break ;
        }

    }
    // für eine eventuelle weiterverarbeitung mitgeben
    XT::setValue('address_ids',$address_ids);
}

?>