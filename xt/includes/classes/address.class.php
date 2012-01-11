<?php

/**
 * S-Node XT Address Entity
 *
 * Example of updating an existing address entry (ID: 1)
 * =====================================================
 *
 * $address = new XT_Address(1);
 * $address->setLastName("Sandler");
 * $address->setFirstName("Adam");
 * $address->save();
 *
 * Example of creating a new entry
 * ===============================
 *
 * $address = new XT_Address();
 * $address->setLastName("Mueller");
 * $address->setFirstName("Beat");
 * $address->setPostalCode(8000);
 * $address->setCity("Z?rich");
 * $address->save();
 *
 * Example of deleting an entry
 * ============================
 *
 * $address = new XT_Address(1);
 * $address->delete();
 *
 * Example of reindexing an entry
 * ==============================
 *
 * $address = new XT_Address(1);
 * $address->index();
 *
 * @author Roger Dudler <rdudler@iframe.ch>
 */

define('XT_ADDRESS_UNKNOWN', 0);
define('XT_ADDRESS_ORGANIZATION', 1);
define('XT_ADDRESS_ORGANIZATIONAL_UNIT', 2);
define('XT_ADDRESS_PERSON', 3);

define('XT_ADDRESS_MALE', 1);
define('XT_ADDRESS_FEMALE', 2);

/**
 * Address entity class
 */
class XT_Address {

    /**
     * Main address data table
     *
     * @var string
    */
    var $_table = 'addresses';

    /**
     * Content type of an address
     *
     * @var int
     * @access private
     */
    var $_contentType = 7400;

    /**
     * ID of the address
     *
     * @var int
     * @access private
     */
    var $_id = 0;

    /**
     * Title of the address
     *
     * @var string
     * @access private
     */
    	var $_title = '';

    /**
     * First name of the person
     *
     * @var string
     * @access private
     */
    var $_firstName = '';

    /**
     * Last name of the person
     *
     * @var string
     * @access private
     */
    var $_lastName = '';

    /**
     * Street of the address
     *
     * @var string
     * @access private
     */
    var $_street = '';

    /**
     * City of the address
     *
     * @var string
     * @access private
     */
    var $_city = '';

    /**
     * Company of the address
     *
     * @var string
     * @access private
     */
    var $_company = '';

    /**
     * Identifier of the address
     *
     * @var string
     * @access private
     */
    var $_identifier = '';

    /**
     * Postal code of the address
     *
     * @var int
     * @access private
     */
    var $_postalCode = 0;

    /**
     * Organization ID of the address
     *
     * @var int
     * @access private
     */
    var $_organization = 0;

    /**
     * Organizational Unit ID of the address
     *
     * @var int
     * @access private
     */
    var $_organizationalUnit = 0;

    /**
     * Country code of the address
     *
     * @var string
     * @access private
     */
    var $_country = '';

    /**
     * Gender of the person
     *
     * @var int
     * @access private
     */
    var $_gender = XT_ADDRESS_MALE;

    /**
     * Type of the address
     *
     * @var int
     * @access private
     */
    var $_type = XT_ADDRESS_UNKNOWN;

    /**
     * Region / State ID of the address
     *
     * @var int
     * @access private
     */
    var $_state = 0;
    
    var $_active = 0;
    var $_status = 0;
    var $_email = '';
    var $_emailPrivate = '';
    var $_tel = '';
    var $_telPrivate = '';
    var $_facsimile = '';
    var $_facsimilePrivate = '';
    var $_telMobile = '';
    var $_telMobilePrivate = '';
    var $_website = '';
    var $_public = '';
    var $_position = '';
    var $_image = 0;
    var $_lat = 0;
    var $_lon = 0;
    var $_lang = '';
    var $_is_primary_user_address = 0;
    var $_birthdate = 'NULL';
    var $_birthday = 'NULL';
    var $_display_time_type = 'NULL';
    var $_display_time_start = 'NULL';
    var $_display_time_end = 'NULL';
    
    var $_toUpdate = array();
    var $_data = array();

    /**
     * Has the address entry changed
     *
     * @var boolean
     */
    var $_updated = false;
    
    /**
     * Is this a new address entry
     *
     * @var boolean
     */
    var $_new = true;
    
    /**
     * Is this a deleted address entry
     *
     * @var boolean
     */
    var $_deleted = false;
    
    /**
     * Has data been loaded
     *
     * @var boolean
     */
    var $_dataLoaded = false;


    function XT_Address($address_id = 0){
        $this->_id = $address_id;
        if($this->_id > 0){
            $this->_new = false;
        }
        $this->getData();
    }

    function findBestAddress($array){

        // table layout abrufen
        $result = XT::query("
            SHOW
                columns
            FROM
                " . XT::getDatabasePrefix() . "addresses
        ",__FILE__,__LINE__);

        $res = XT::getQueryData($result);

        $tablelayout = array();

        foreach($res as $value) {
            $tablelayout[$value['Field']] = $value['Type'];
        }

        // jedes feld das mitkommt zaehlt auch
        foreach ($array as $key => $value) {
            if(array_key_exists($key, $tablelayout)) {

                $result = XT::query("
                    SELECT
                        id
                    FROM
                        " . XT::getDatabasePrefix() . "addresses
                    WHERE
                        " . $key . "='" . $value . "'
                ",__FILE__,__LINE__);

                // jeder Treffer einer Adresse zuordnen
                while($row = $result->FetchRow()){
                    $possible_ids[$row['id']]++;
                }
                
                // die anzahl felder nochzaehlen
                $compared_keys ++;
                
            }
        }

        // falls es teiltreffer gibt diese analysieren
        if(is_array($possible_ids)){

            // sortiert den Array mit der hoechsten value zuerst, ohne den Schluessel zu verlieren
            arsort($possible_ids);

            $i = 0;
            
            // die moeglichen treffer bestimmen (sie muessen mind. in 80% der Treffer vorkommen)
            foreach($possible_ids as $possible_id => $value) {
                
                if($i == 0) {
                    $maxval = $value;
                }
                if($value > intval($compared_keys * 0.8) && $value == $maxval) {
                    $to_return_ids[$i] = $possible_id;
                }
                if($i > 0) {
                    break;
                }
                
                $i++;
            }
        
            // falls es nur einen moeglichen treffer gibt weiter machen
            if(count($to_return_ids) == 1) {
                return $to_return_ids[0];
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
        
    }
    
    function getuserid() {
        return $this->_user_id;
    }
    function getID(){
        return $this->_id;
    }
    
    function getTitle(){
        return $this->_title;
    }
    
    function getType(){
        return $this->_type;
    }
    
    function getActive(){
        return $this->_active;
    }
    
    function getEmail(){
        return $this->_email;
    }
    
    function getLastName(){
        return $this->_lastName;
    }
    
    function getPrimaryUserAddress(){
        return $this->_is_primary_user_address;
    }
    
    function getFirstName(){
        return $this->_firstName;
    }
    
    function getCity(){
        return $this->_city;
    }
    
    function getStreet(){
        return $this->_street;
    }
    
    function getCompany(){
        return $this->_company;
    }
    function getIdentifier(){
        return $this->_identifier;
    }
    
    function getBirthdate(){
        return $this->_birthdate;
    }
    function getDisplay_time_type(){
        return $this->_display_time_type;
    }
    
    function getDisplay_time_end(){
        return $this->_display_time_end;
    }
    
    function getDisplay_time_start(){
        return $this->_display_time_start;
    }
    
    function getBirthday(){
        return $this->_birthday;
    }
    
    function getTelephone(){
        return $this->_tel;
    }
    
    function getCountry(){
        return $this->_country;
    }
    
    function getState(){
        return $this->_state;
    }
    
    function getPostalCode(){
        return $this->_postalCode;
    }
    
    function getImage(){
        return $this->_image;
    }
    
    function getGender(){
        return $this->_gender;
    }
    function getSkype(){
        return $this->_skype;
    }
    function getOrganization(){
        return $this->_data["organization"];
    }
    function getorganizationalUnit(){
        return $this->_data["organizationalUnit"];
    }
    
    function getDescription() {
        return $this->_description;
    }
    
    function getLatitude() {
        return $this->_lat;
    }
    
    function getLongitude() {
        return $this->_lon;
    }
    
    function getLang() {
        return $this->_lang;
    }
    
    function setID($id=0){
        $this->_id = $id;
    }

    function setLastName($lastName){
        $this->_lastName = trim($lastName);
        $this->update('lastName',$this->getLastName());
    }
    function setPrimaryUserAddress($bool){
        $this->_is_primary_user_address = $bool;
        $this->update('is_primary_user_address',$this->getPrimaryUserAddress());
    }
    function setuserid($userID) {
        $this->_user_id = $userID;
        $this->update('user_id',$this->getuserid());
    }
    function setFirstName($firstName){
        $this->_firstName = trim($firstName);
        $this->update('firstName',$this->getFirstName());
    }
    
    function setCity($city){
        $this->_city = trim($city);
        $this->update('city',$this->getCity());
    }
    function setCompany($company){
        $this->_company = trim($company);
        $this->update('company',$this->getCompany());
    }
    
    function setIdentifier($identifier){
        $this->_identifier = $identifier;
        $this->update('identifier',$this->getIdentifier());
    }
    function setDisplay_time_type($int){
        $this->_display_time_type = $int;
        $this->update('display_time_type',$this->getDisplay_time_type());
    }
    function setDisplay_time_start($int){
        $this->_display_time_start = $int;
        $this->update('display_time_start',$this->getDisplay_time_start());
    }
    function setDisplay_time_end($int){
        $this->_display_time_end = $int;
        $this->update('display_time_end',$this->getDisplay_time_end());
    }
    
    function setBirthdate($birthdate){
        $this->_birthdate = $birthdate;
        if(is_numeric($birthdate)){
            $this->_birthday = mktime(1,0,0,date("m",$birthdate),date("d",$birthdate),1970);;
            $this->update('birthday',$this->getBirthday());
        }
        $this->update('birthdate',$this->getBirthdate());
    
    }
    
    function setOrganization($organization){
        $this->_organization = $organization;
        $this->update('organization',$organization);
    }
    function setOrganizationalUnit($organizationalUnit){
        $this->_organizationalUnit = $organizationalUnit;
        $this->update('organizationalUnit',$organizationalUnit);
    }
    function setStreet($street){
        $this->_street = trim($street);
        $this->update('street',$street);
    }
    
    function setState($state) {
        $this->_state= $state;
        $this->update('state',$state);
    }
    function setStatus($status) {
        $this->_status= $status;
        $this->update('status',$status);
    }
    function setEMail($email) {
        if(XT::checkEmail(trim($email))) {
            $this->_email = trim($email);
            $this->update('email', $email);
        }
        elseif($email == "") {
            $this->_email = "";
            $this->update('email', $email);
        }
    }
    function setEMailPrivate($email_private) {
        if(XT::checkEmail(trim($email_private))){
            $this->_email_private = trim($email_private);
            $this->update('email_private', $email_private);
        }
        elseif($email_private == "") {
            $this->_email_private = "";
            $this->update('email_private', $email_private);
        }
    }
    function setPosition($position) {
        $this->_position= trim($position);
        $this->update('position',$position);
    }
    function setTelephone($tel) {
        $this->_tel= trim($tel);
        $this->update('tel',$tel);
    }
    function setTelephonePrivate($tel_private) {
        $this->_tel_private= trim($tel_private);
        $this->update('tel_private',$tel_private);
    }
    function setTelephoneMobile($tel_mobile) {
        $this->_tel_mobile= trim($tel_mobile);
        $this->update('tel_mobile',$tel_mobile);
    }
    function setTelephoneMobilePrivate($tel_mobile_private) {
        $this->_tel_mobile_private= trim($tel_mobile_private);
        $this->update('tel_mobile_private',$tel_mobile_private);
    }
    function setFacsimile($fax) {
        $this->_fax= trim($fax);
        $this->update('fax',$fax);
    }
    function setFacsimilePrivate($fax_private) {
        $this->_fax_private= trim($fax_private);
        $this->update('fax_private',$fax_private);
    }
    function setWebsite($website) {
        $this->_website= trim($website);
        $this->update('website',$website);
    }
    function setSkype($skype) {
        $this->_skype= trim($skype);
        $this->update('skype',$skype);
    }
    function setPublic($public) {
        $this->_public= $public;
        $this->update('public',$public);
    }
    
    function setCountry($country){
        $this->_country = trim($country);
        $this->update('country',$this->getCountry());
    }
    
    function setPostalCode($postalCode){
        $this->_postalCode = trim($postalCode);
        $this->update('postalCode',$this->getPostalCode());
    }
    
    function setImage($image){
        $this->_image = $image;
        $this->update('image',$this->getImage());
    }
    
    function setGender($gender){
        $this->_gender = $gender;
        $this->update('gender',$this->getGender());
    }
    
    function setTitle($title){
        $this->_title = trim($title);
        $this->update('title',$this->getTitle());
    }
    
    function setType($type){
        $this->_type = $type;
        $this->update('type',$this->getType());
    }
    
    function setActive($bool) {
        if($bool) {
            $this->_active = 1;
        }
        else {
            $this->_active = 0;
        }
        $this->update('active',$this->getActive());
    }
    
    function setDescription($description){
        $this->_description = trim($description);
        $this->update('description',$description);
    }
    
    function setLatitude($lat){
        $this->_lan = floatval($lat);
        $this->update('lat',$lat);
    }
    
    function setLongitude($lon){
        $this->_lon = floatval($lon);
        $this->update('lon',$lon);
    }
    
    function setLang($lang){
        $this->_lang = $lang;
        $this->update('lang',$lang);
    }
    
    function isActive(){
        if($this->_active) {
            return(true);
        }
        else {
            return(false);
        }
    }
    
    function isMale(){
        return $this->_gender == XT_ADDRESS_MALE;
    }
    
    function isFemale(){
        return $this->_gender == XT_ADDRESS_FEMALE;
    }
    
    function isPerson(){
        return $this->_type == XT_ADDRESS_PERSON;
    }
    
    function isOrganization(){
        return $this->_type == XT_ADDRESS_ORGANIZATION;
    }
    
    function isOrganizationalUnit(){
        return $this->_type == XT_ADDRESS_ORGANIZATIONAL_UNIT;
    }
    
    function isUpdated(){
        return $this->_updated;
    }
    
    function isDeleted(){
        return $this->_deleted;
    }
    
    function isNew(){
        return $this->_new;
    }
    
    function generateTitle(){
        $this->setTitle($this->getLastName() . ' ' . $this->getFirstName());
        $this->update('title',$this->getTitle());
    }
    
    function update($field, $new_value){
        $this->_toUpdate[$field] = $new_value;
    }
    
    function save(){
    
        // If no ID is set, create a new address
        if($this->_new){
    
            // wenn über setID eine ID explizit verlangt wurde, diese auch verwenden
            if(is_int($this->_id) && $this->_id > 0){
                $insertquerry = "
                INSERT INTO
                    " . XT::getDatabasePrefix() . $this->_table . "
                (
                    id,
                    creation_date,
                    creation_user
                ) VALUES (
                    " . $this->_id . ",
                    " . time() . ",
                    " . XT::getUserID() . "
                )";
                XT::query($insertquerry,__FILE__,__LINE__);
    
                $this->setID($this->_id);
    
            }
            else {
                $insertquerry = "
                INSERT INTO
                    " . XT::getDatabasePrefix() . $this->_table . "
                (
                    creation_date,
                    creation_user
                ) VALUES (
                    " . time() . ",
                    " . XT::getUserID() . "
                )";
                XT::query($insertquerry,__FILE__,__LINE__);
    
    
                // Get the new id
                $result = XT::query("
                    SELECT
                        id
                    FROM
                      " . XT::getDatabasePrefix() . $this->_table . "
                    ORDER BY
                        id DESC
                    LIMIT 1
                ",__FILE__,__LINE__);
    
                $data = XT::getQueryData($result);
                $this->setID($data[0]['id']);
    
            }
    
        }
    
        // If there are updated fields, build update query
        if(sizeof($this->_toUpdate) > 0){
    
            $sql = "";
            foreach($this->_toUpdate as $field => $value){
                $sql .= $field . " = '" . $value . "',";
            }
    
            XT::query("
                UPDATE
                    " . XT::getDatabasePrefix() . $this->_table . "
                SET
                    " . $sql ."
                    mod_date = " . time() . ",
                    mod_user = " . XT::getUserID() . "
                WHERE
                    id = " . $this->getID() . "
            ",__FILE__,__LINE__);
            $this->_updated = true;
        } else {
            $this->_updated = false;
        }
        // Search
        $this->index($this->_public);
    }
    
    /**
     * Get current address entry data
     */
    function getData(){
    
        // Check if data was already loaded or ID is not set
        if(!$this->_dataLoaded && $this->getID() > 0){
    
            // Get data
            $result = XT::query("
                SELECT
                    a.id,
                    a.type,
                    a.firstName,
                    a.lastName,
                    a.title,
                    a.city,
                    a.company,
                    a.postalCode,
                    a.country,
                    a.state,
                    a.street,
                    a.email,
                    a.email_private,
                    a.tel,
                    a.tel_private,
                    a.fax,
                    a.fax_private,
                    a.gender,
                    a.website,
                    a.user_id,
                    a.is_primary_user_address,
                    a.active,
                    a.organization as organization_id,
                    a.organizationalUnit as organizationalUnit_id,
                    a.image,
                    a.birthdate,
                    a.lat,
                    a.lon,
                    a.lang,
                    a.identifier,
                    o.title as organization,
                    ou.title as organizationalUnit
                FROM
                    " . XT::getDatabasePrefix() . $this->_table . " as a LEFT JOIN
                    " . XT::getDatabasePrefix() . $this->_table . " as o ON (o.id = a.organization) LEFT JOIN
                    " . XT::getDatabasePrefix() . $this->_table . " as ou ON (ou.id = a.organizationalUnit)
                WHERE
                    a.id = " . $this->getID() . "
                LIMIT 1
            ",__FILE__,__LINE__);
    
            while($row = $result->FetchRow()){
                $this->_data = $row;
                $this->_type = $row['type'];
                $this->_firstName = $row['firstName'];
                $this->_lastName = $row['lastName'];
                $this->_title = $row['title'];
                $this->_city = $row['city'];
                $this->_company = $row['company'];
                $this->_identifier = $row['identifier'];
                $this->_postalCode = $row['postalCode'];
                $this->_country = $row['country'];
                $this->_state = $row['state'];
                $this->_street = $row['street'];
                $this->_image = $row['image'];
                $this->_lat = $row['lat'];
                $this->_lon = $row['lon'];
                $this->_lang = $row['lang'];
                $this->_email = $row['email'];
                $this->_emailPrivate = $row['email_private'];
                $this->_tel = $row['tel'];
                $this->_telPrivate = $row['tel_private'];
                $this->_facsimile = $row['fax'];
                $this->_facsimilePrivate = $row['fax_private'];
                $this->_gender = $row['gender'];
                $this->_website = $row['website'];
                $this->_user_id = $row['user_id'];
                $this->_birthdate = $row['birthdate'];
                $this->_is_primary_user_address = $row['is_primary_user_address'];
                $this->_active = $row['active'];
            }
        }
        $this->_dataLoaded = true;
        return $this->_data;
    }
    
    /**
     * Adds this address to the search index
     */
    function index($public = true){
    
        // Add to search index
        XT::loadClass('searchindex.class.php','ch.iframe.snode.search');
        $searchindex = new XT_SearchIndex($this->getID(),$this->getContentType(),$public);
        $searchindex->add(addslashes(stripslashes($this->_firstName)));
        $searchindex->add(addslashes(stripslashes($this->_lastName)));
        $searchindex->add(addslashes(stripslashes($this->_postalCode)));
        $searchindex->add(addslashes(stripslashes($this->_city)));
        $searchindex->add(addslashes(stripslashes($this->_company)));
        $searchindex->add(addslashes(stripslashes($this->_street)));
        $searchindex->add(addslashes(stripslashes($this->_email)));
        $searchindex->add(addslashes(stripslashes($this->_emailPrivate)));
        $searchindex->add(addslashes(stripslashes($this->_facsimile)));
        $searchindex->add(addslashes(stripslashes($this->_facsimilePrivate)));
        $searchindex->add(addslashes(stripslashes($this->_website)));
        $searchindex->build(addslashes(stripslashes($this->getTitle())),addslashes(stripslashes($this->_street))
        . "<br /> " . addslashes(stripslashes($this->_city))
        . "<br /> " . addslashes(stripslashes($this->_tel))
        . "<br /> " . addslashes(stripslashes($this->_website)), (0 + $this->getImage()));
        return true;
    
    }
    
    /**
     * Delete this address
     */
    function delete(){
    
        // Remove from search index
        XT::loadClass('searchindex.class.php','ch.iframe.snode.search');
        $searchindex = new XT_SearchIndex($this->getID(),$this->getContentType());
        $searchindex->delete();
    
        // Delete data entry
        $result = XT::query("
            DELETE FROM
                " . XT::getDatabasePrefix() . $this->_table . "
            WHERE
                id = " . $this->getID() . "
        ",__FILE__,__LINE__);
    
        return true;
    
    }
    
    function activate() {
        $result = XT::query("
            UPDATE
                " . XT::getDatabasePrefix() . $this->_table . "
            SET active=1
            WHERE
                id = " . $this->getID() . "
        ",__FILE__,__LINE__);
        XT::log('User ' . $this->getID() . ' activated',__FILE__,__LINE__,XT_NOTICE);
    }
    
    function deactivate() {
        $result = XT::query("
            UPDATE
                " . XT::getDatabasePrefix() . $this->_table . "
            SET active=0
            WHERE
                id = " . $this->getID() . "
        ",__FILE__,__LINE__);
        XT::log('User ' . $this->getID() . ' deactivated',__FILE__,__LINE__,XT_NOTICE);
    }
    
    /**
     * Gets the content type of this object
     *
     * @return Content Type ID
     */
    function getContentType(){
        return $this->_contentType;
    }
    
    function export($type = 'XML', $target_file = ''){
    
        // Get fresh data
        $this->_dataLoaded = false;
        $this->getData();
    
        switch($type){
    
            case 'XML':
    
                $xml = "<?xml version=\"1.0\"?>\n";
                $xml .= "<address>\n";
    
                foreach ($this->_data as $field => $value) {
                    $xml .= "    <" . $field . ">";
                    $xml .= XT::replaceXMLEntities($value);
                    $xml .= "</" . $field . ">\n";
                }
    
                $xml .= "</address>";
    
                // Write XML data to the file
                @mkdir(DATA_DIR . 'exports');
                @mkdir(DATA_DIR . 'exports/ch.iframe.snode.addresses');
                @mkdir(DATA_DIR . 'exports/ch.iframe.snode.addresses/xml');
                file_put_contents(DATA_DIR . 'exports/ch.iframe.snode.addresses/xml/' . $this->getID() . '.xml', $xml);
                break;
    
            case 'vCard':
    
                $vCard = "";
                $vCard .= "BEGIN:vCard\n";
                $vCard .= "VERSION:3.0\n";
                if($this->getLastName() != ''){
                    $vCard .= "FN:" . $this->getFirstName() . " " . $this->getLastName() . "\n";
                    $vCard .= "N:" . $this->getLastName() . ";" . $this->getFirstName() . "\n";
                }
                if($this->_data['organization'] != ''){
                    $vCard .= "ORG:" . $this->_data['organization'] . "\n";
                }
                if($this->_website != ''){
                    $vCard .= "URL:" . $this->_website . "\n";
                }
                $vCard .= "END:vCard\n";
    
                // Write vCard data to the file
                @mkdir(DATA_DIR . 'exports');
                @mkdir(DATA_DIR . 'exports/ch.iframe.snode.addresses');
                @mkdir(DATA_DIR . 'exports/ch.iframe.snode.addresses/vCards');
                file_put_contents(DATA_DIR . 'exports/ch.iframe.snode.addresses/vCards/' . $this->getID() . '.vcf', $vCard);
                break;
        }
    
    }
    
    
    function get_address_id_by_identifier($identifier){
        // Adresse auf existierende pruefen
        $result = XT::query("
           SELECT
                id
           FROM
                " . XT::getDatabasePrefix() . "addresses
           WHERE
                identifier = '" . $identifier . "'",__FILE__,__LINE__);
    
        $res = XT::getQueryData($result);
        if(!empty($res[0]['id'])){
            return $res[0]['id'];
        }else {
            return false;
        }
    }

}