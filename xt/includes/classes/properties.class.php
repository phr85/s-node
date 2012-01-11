<?php

class properties {


    /**
	 * @var array $_dbTables List of all used database tables
	 */
    var $_dbTables;

    /**
     * @var string $_lang Active language
     */
    var $_lang;
    /**
     * Constructor
     * @param int $id Identification number of the property
     * @param int $contentType Content type to assign the property value to a plugin or something else
     */
    function properties($lang = "") {


        /**
    	 * Main properties table
    	 */
        $this->dbTables['properties'] = XT::getDatabasePrefix() . "properties";

        /**
    	 * Property details (translation and descriptions)
    	 */
        $this->dbTables['properties_details'] = XT::getDatabasePrefix() . "properties_details";

        /**
    	 * Relation between groups and properties
    	 */
        $this->dbTables['groups_rel'] = XT::getDatabasePrefix() . "properties_group2properties";

        /**
    	 * Stored values for each property
    	 */
        $this->dbTables['properties_values'] = XT::getDatabasePrefix() . "properties_values";

        /**
    	 * Property groups
    	 */
        $this->dbTables['groups'] = XT::getDatabasePrefix() . "properties_groups";

        /**
    	 * Property groups details
    	 */
        $this->dbTables['groups_details'] = XT::getDatabasePrefix() . "properties_groups_details";

        /**
    	 * Permission for each property
    	 */
        $this->dbTables['perms'] = XT::getDatabasePrefix() . "properties_perms";

        if ($lang != "")  {
            $this->_lang = $lang;
        } else {
            $this->_lang = XT::getLang();
        }
    }



    /**
     * Add a property
     * @param int $contentType Content type of the property
     * @param string $title Title of the property
     * @param string $description Description of the property. Default empty
     * @param int $type Type of the property.
     * @param mixed $value Default value of the property.
     * @param int $position Position flag. Default 0
     * @return int Returns the new generated id
     */
    function addProperty($contentType,$title,$type,$value,$description = "",$position = 0) {

        // Add a property
        XT::query("
		    INSERT INTO
		        " . $this->dbTables['properties'] . "
		    (
		        content_type,
		        type,
				value,
				position
		    ) VALUES (
		        " . $contentType . ",
		        " . $type . ",
				'" . $value . "',
				" . $position . "
		    )
		",__FILE__,__LINE__);

        // Get the new id
        $result = XT::query("
			    SELECT
			        id
			    FROM
			      " . $this->dbTables['properties'] . "
			    ORDER BY
			        id DESC
			    LIMIT 1
			",__FILE__,__LINE__);

        $data = XT::getQueryData($result);
        $id =  $data[0]['id'];

        // Add a property detail
        foreach($GLOBALS['cfg']->getLangs() as $lang => $langname) {
            XT::query("
			    INSERT INTO
			        " . $this->dbTables['properties_details'] . "
			    (
			        property_id,
			        title,
					lang,
					description
			    ) VALUES (
			        " . $id . ",
			        '" . $title . "',
					'" . $lang . "',
	 				'" . $description . "'
			    )
			",__FILE__,__LINE__);
        }
        return $id;
    }

    /**
     * Delete a property
     * @param int $propertyId ID of the property
     * @param bool $deleteValues Deletes also the property values if its true.
     * @todo Implement a real return value
     */
    function delProperty($propertyId, $deleteValues = false) {
        // Delete main property
        XT::query("DELETE FROM " . $this->dbTables['properties'] . " WHERE id=" . $propertyId,__FILE__,__LINE__);
        // Delete property detail
        XT::query("DELETE FROM " . $this->dbTables['properties_details'] . " WHERE property_id=" . $propertyId,__FILE__,__LINE__);
        // Delete the relation to the groups
        XT::query("DELETE FROM " . $this->dbTables['groups_rel'] . " WHERE property_id=" . $propertyId,__FILE__,__LINE__);
        // Delete Permission
        XT::query("DELETE FROM " . $this->dbTables['perms'] . " WHERE property_id=" . $propertyId,__FILE__,__LINE__);
        // Delete values if you want
        if ($deleteValues == true) {
            XT::query("DELETE FROM " . $this->dbTables['properties_values'] . " WHERE property_id=" . $propertyId,__FILE__,__LINE__);

        }
    }

    /**
     * Rename a property
     * @param int $propertyId ID of the property
     * @param string $newTitle New title
     * @param string $lang Language of the new title
     * @todo Implement a real return value
     */
    function renameProperty ($propertyId,$newTitle,$lang, $description = false) {
        // Rename all by default
        $renameAll = true;
        if ($lang != $GLOBALS['cfg']->get('lang', 'default')) {
            $renameAll = false;
            // Check if one of the names are modified
        } elseif ($this->isPropertyNameModified($propertyId)) {
            $renameAll = false;
        }
        // Change just the one of the language if $renameAll == false
        if ($renameAll == false) {
            // Change the decription if set
            if ($description != false) {
                $desc = ", description='" . $description . "'";
            }
            XT::query("UPDATE
				" . $this->dbTables['properties_details'] . "
				SET
				title='" .$newTitle . "',
				modified=1
				" .  $desc . "
				WHERE
				property_id=" . $propertyId . "
				AND lang='" . $lang . "'
			",__FILE__,__LINE__);
        } else {
            foreach($GLOBALS['cfg']->getLangs() as $lang => $langname) {

                // Change the decription if set
                if ($description != false) {
                    $desc = ", description='" . $description . "'";
                }

                XT::query("UPDATE
				" . $this->dbTables['properties_details'] . "
				SET
				title='" .$newTitle . "',
				modified=0
				" .  $desc . "
				WHERE
				property_id=" . $propertyId . "
				AND lang='" . $lang . "'
				",__FILE__,__LINE__);
            }
        }
    }

    /**
     * Detects if the property is modified
     * @param int $propertyId The id of the property
     * @return bool Returns true if the modified flag is set in one of the languages except of the default language.
     */
    function isPropertyNameModified($propertyId){
        $isPropertyNameModified = false;
        $SQL = "SELECT *
				FROM
				" . $this->dbTables['properties_details'] . "
				WHERE
				lang != '" . $GLOBALS['cfg']->get('lang', 'default') . "'
				AND property_id=" . $propertyId;
        $result = XT::query($SQL,__FILE__,__LINE__);
        while($row = $result->FetchRow()){
            if ($row['modified'] == 1) {
                $isPropertyNameModified = true;
            }
        }
        return $isPropertyNameModified;
    }

    function setPropertyPosition($propertyId,$position) {
        XT::query("UPDATE " . $this->dbTables['properties'] . " set position=" . $position . " WHERE id=" . $propertyId,__FILE__,__LINE__);
    }
    function setPropertyContentType($propertyId,$contentType) {
        XT::query("UPDATE " . $this->dbTables['properties'] . " set content_type=" . $contentType . " WHERE id=" . $propertyId,__FILE__,__LINE__);
    }
    function setPropertyType($propertyId,$type) {
        XT::query("UPDATE " . $this->dbTables['properties'] . " set type='" . $type . "' WHERE id=" . $propertyId,__FILE__,__LINE__);
    }
    function setPropertyValue($propertyId,$value) {
        XT::query("UPDATE " . $this->dbTables['properties'] . " set value='" . $value. "' WHERE id=" . $propertyId,__FILE__,__LINE__);
    }

    /**
     * Get all properties for a property
     * @param int $propertyId ID of the property
     * @return array All datas for the requested property
     */
    function getPropertyAttributes($propertyId) {
        $SQL = "SELECT prop.*, det.*
				FROM
				" . $this->dbTables['properties'] . " as prop,
				" . $this->dbTables['properties_details'] . " as det
				WHERE
				prop.id=" . $propertyId . "
				AND prop.id = det.property_id
				AND det.lang='" . $this->_lang . "'";
        $result = XT::query($SQL,__FILE__,__LINE__);
        $data = XT::getQueryData($result);
        return $data[0];
    }

    /**
     * Get all properties
     * @param int $contentType Return just the properties for this content type
     * @return array All datas for the requested properties
     */
    function getPropertiesAttributes($contentType = "") {
        $SQL = "SELECT prop.*, det.*
				FROM
				" . $this->dbTables['properties'] . " as prop,
				" . $this->dbTables['properties_details'] . " as det
				WHERE
				prop.id = det.property_id
				AND det.lang='" . $this->_lang . "'";

        if ($contentType != "") {
            $SQL = $SQL . " AND prop.content_type=" . $contentType;
        }

        $result = XT::query($SQL,__FILE__,__LINE__);
        $data = XT::getQueryData($result);
        return $data;
    }

    ////////////////////// Group ///////////////////////

    /**
	 * Add a new group
	 * @var string $title Title of the group
	 * @var string $description Description for the group
	 * @var string $lang Language
	 * @return the id of the new group
	 */
    function addGroup($title, $description = "", $lang = "") {
        if ($lang == "") {
            $lang = $this->_lang;
        }

        // Add a property
        XT::query("
		    INSERT INTO
		        " . $this->dbTables['groups'] . " (id) values (NULL)
		",__FILE__,__LINE__);

        // Get the new id
        $result = XT::query("
		    SELECT
		        id
		    FROM
		      " . $this->dbTables['groups'] . "
		    ORDER BY
		        id DESC
		    LIMIT 1
		",__FILE__,__LINE__);
        $data = XT::getQueryData($result);
        $id =  $data[0]['id'];

        foreach($GLOBALS['cfg']->getLangs() as $lang => $langname) {
            XT::query("
			    INSERT INTO
			        " . $this->dbTables['groups_details'] . "
			    (
			        group_id,
			        title,
					lang,
					description
			    ) VALUES (
			        " . $id . ",
			        '" . $title . "',
					'" . $lang . "',
	 				'" . $description . "'
			    )
			",__FILE__,__LINE__);
        }

        return $id;
    }

    /**
	 * Delete a group
	 * @var int $groupId Id of the group
	* @todo Implement a real return value
	 */
    function delgroup($groupId) {
        // Delete the group
        XT::query("DELETE FROM  " . $this->dbTables['groups'] . " WHERE id=" . $groupId,__FILE__,__LINE__);
        // Delete the relations
        XT::query("DELETE FROM " . $this->dbTables['groups_rel'] . " WHERE group_id=" . $propertyId,__FILE__,__LINE__);

    }



    /**
     * Rename a Group
     * @param int $groupId ID of the Group
     * @param string $newTitle New title
     * @param string $lang Language of the new title
     */
    function renameGroup ($groupId,$newTitle,$lang, $description = false) {
        // Rename all by default
        $renameAll = true;
        if ($lang != $GLOBALS['cfg']->get('lang', 'default')) {
            $renameAll = false;
            // Check if one of the names are modified
        } elseif ($this->isgroupNameModified($groupId)) {
            $renameAll = false;
        }
        // Change just the one of the language if $renameAll == false
        if ($renameAll == false) {
            // Change the decription if set
            if ($description != false) {
                $desc = ", description='" . $description . "'";
            }
            // nur einzelnen ändern
            XT::query("UPDATE
				" . $this->dbTables['groups_details'] . "
				SET
				title='" .$newTitle . "',
				modified=1
				" .  $desc . "
				WHERE
				group_id=" . $groupId . "
				AND lang='" . $lang . "'
			",__FILE__,__LINE__);
        } else {
            // jede sprache für sich ändern die noch nicht geändert wurde
            foreach($GLOBALS['cfg']->getLangs() as $lang => $langname) {
                // Change the decription if set
                if ($description != false) {
                    $desc = ", description='" . $description . "'";
                }
                XT::query("UPDATE
				" . $this->dbTables['groups_details'] . "
				SET
				title='" .$newTitle . "',
				modified=0
				" .  $desc . "
				WHERE
				group_id=" . $groupId . "
				AND lang='" . $lang . "'
				",__FILE__,__LINE__);
            }
        }
    }
    function isGroupNameModified($groupId){
        $isgroupNameModified = false;
        $SQL = "SELECT *
				FROM
				" . $this->dbTables['groups_details'] . "
				WHERE
				lang != '" . $GLOBALS['cfg']->get('lang', 'default') . "'
				AND group_id=" . $groupId;
        $result = XT::query($SQL,__FILE__,__LINE__);
        while($row = $result->FetchRow()){
            if ($row['modified'] == 1) {
                $isgroupNameModified = true;
            }
        }
        return $isgroupNameModified;
    }

}
?>